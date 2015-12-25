<?php
function wpgo_substrUtf8($string, $length, $replace = '…') {
  $str = $string;
  // 先截取指定长度的字符串
  if (strlen ( $string ) < $length) {
    $str = substr ( $string, 0 );
  } else {
    $char = ord ( $string [$length - 1] );
    if ($char >= 224 && $char <= 239) {
      $str = substr ( $string, 0, $length - 1 );
    } else {
      $char = ord ( $string [$length - 2] );
      if ($char >= 224 && $char <= 239) {
        $str = substr ( $string, 0, $length - 2 );
      } else {
        $str = substr ( $string, 0, $length );
      }
    }
  }
  // 提取截取出来的字符串中出现的html开始和闭合标签的值和位置索引
  $starts = $start_str = $ends = array ();
  preg_match_all ( '/<\w+[^>]*>?/', $str, $starts, PREG_OFFSET_CAPTURE );
  preg_match_all ( '/<\/\w+>/', $str, $ends, PREG_OFFSET_CAPTURE );

  $cut_pos = 0;
  $last_str = '';
  if (! empty ( $starts [0] )) {
    $starts = array_reverse ( $starts [0] );
    if (! empty ( $ends [0] )) {
      $ends = array_reverse ( $ends [0] );
    }
    // 根据开始标签和结束标签的字符串索引大小和值是否相等来获取可以截取的长度
    foreach ( $starts as $sk => $s ) {
      if ($auto = strripos ( $s [0], '/>' )) {
        if ($cut_pos < $auto) {
          $cut_pos = $s [1];
          $last_str = $s [0];
          unset ( $starts [$sk] );
        }
      } else {
        preg_match ( '/<(\w+).*>?/', $s [0], $start_str );
        if (! empty ( $ends )) {
          foreach ( $ends as $ek => $e ) {
            $end_str = trim ( $e [0], '</>' );
            if ($end_str == $start_str [1] && $e [1] > $s [1]) {
              if ($cut_pos < $e [1]) {
                $cut_pos = $e [1];
                $last_str = $e [0];
              }
              unset ( $ends [$ek] );
              break;
            } else {
              $last_str = '';
              $cut_pos = 0;
            }
          }
        } else {
          $last_str = '';
          $cut_pos = $s [1];
        }
      }
    }
    if ($cut_pos == 0) {
      $starts = array_pop ( $starts );
      $cut_pos = $starts [1];
      $last_str = '';
    }
  }
  // 拼凑剩余的字符串，不包括html标签
  $res_str = substr ( $str, 0, $cut_pos ) . $last_str;
  $less_pos = substr ( $str, strlen ( $res_str ) );
  $less_str = substr ( $less_pos, 0, strpos ( $less_pos, '<' ) );
  $res_str .= $less_str == false ? $less_pos : $less_str;
  return $res_str . $replace;
}

/**
 * 字符串切割
 *
 * 功能：截取字符串（支持中文），如果字符串中包括<a title="查看与html标签有关的文章" href="http://cuelog.com/tag/html%e6%a0%87%e7%ad%be" target="_blank">html标签</a>，截取的字符串则会保留完整的<a title="查看与html标签有关的文章" href="http://cuelog.com/tag/html%e6%a0%87%e7%ad%be" target="_blank">html标签</a>
 * 如果截取的字符串中包含不完整的html标签，则从字符串位置0开始截取到html标签前
 *
 * @param string $string        	
 * @param int $length        	
 * @param string $replace        	
 * @return string
 */
function htmlSubStr ($string, $length = 0, $replace = '…') {
	// 先截取指定长度的字符串，支持中文
	if (strlen ( $string ) < $length) {
		$string = substr ( $string, 0 );
	} else {
		$char = ord ( $string [$length - 1] );
		if ($char >= 224 && $char <= 239) {
			$string = substr ( $string, 0, $length - 1 );
		} else {
			$char = ord ( $string [$length - 2] );
			if ($char >= 224 && $char <= 239) {
				$string = substr ( $string, 0, $length - 2 );
			} else {
				$string = substr ( $string, 0, $length );
			}
		}
	}

	// 开始标签集合,当前开始标签字符串(a,span,div...),结束标签集合
	$starts = $start_str = $ends = array ();
	// 提取截取的字符串中出现的开始标签结合和结束标签集合
	preg_match_all ( '/<\w+[^>]*>?/', $string, $starts, PREG_OFFSET_CAPTURE );
	preg_match_all ( '/<\/\w+>/', $string, $ends, PREG_OFFSET_CAPTURE );

	// 初始化<a title="查看与字符串截取有关的文章" href="http://cuelog.com/tag/%e5%ad%97%e7%ac%a6%e4%b8%b2%e6%88%aa%e5%8f%96" target="_blank">字符串截取</a>点
	$cut_pos = 0;
	// 最后追加的字符串
	$last_str = '';

	if (! empty ( $starts [0] )) {
		$starts = array_reverse ( $starts [0] );
		if (! empty ( $ends [0] )) {
			$ends = $ends [0];
		}

		foreach ( $starts as $sk => $s ) {
			// 判断开始标签是否包括XHTML语法的闭合标签<img alt="">
			$auto = false;
			if ($auto != false && $auto = strripos ( $s [0], '/>' )) {
				// 如果有，则将<a title="查看与字符串截取有关的文章" href="http://cuelog.com/tag/%e5%ad%97%e7%ac%a6%e4%b8%b2%e6%88%aa%e5%8f%96" target="_blank">字符串截取</a>点设置为当前标签的起始位置
				if ($cut_pos < $auto) {
					$cut_pos = $s [1];
					$last_str = $s [0];
					unset ( $starts [$sk] );
				}
			} else {
				// 提取开始标签名：a,div,span...
				preg_match ( '/<(\w+).*>?/', $s [0], $start_str );
				if (! empty ( $ends )) {
					foreach ( $ends as $ek => $e ) {
						// 提取结束标签名
						$end_str = trim ( $e [0], '</>' );
						// 如果开始标签名与结束标签名一致，并且结束标签的索引值比开始标签的索引值大，则该标签是完整的有效.
						if ($end_str == $start_str [1] && $e [1] > $s [1]) {
							// 如果字符串截取点还没有确定，给它赋值
							if ($cut_pos < $e [1]) {
								$cut_pos = $e [1];
								// 并且将闭合标签作为最后的字符串追加
								$last_str = $e [0];
							}
							// 将这个正确的标签去掉结束标签，并且滚入下一个开始标签的判断
							unset ( $ends [$ek] );
							break;
						}
					}
				} else {
					/*
					 * 如果empty($ends)，说明第一个开始标签没有对应的闭合标签 说明这一段截取的内容不完整，只能将字符串截取到第一个开始标签前为止
					 */
					$last_str = '';
					$cut_pos = $s [1];
				}
			}
		}
		// 拼凑剩余的字符串
		$res_str = substr ( $string, 0, $cut_pos ) . $last_str;
		$less_str = substr ( $string, strlen ( $res_str ) );
		$less_pos = strpos ( $less_str, '<' );
		$less_str = $less_pos !== false ? substr ( $less_str, 0, $less_pos ) : $less_str;
		$string = $res_str . $less_str . $replace;
	}
	return $string;
}


?>
