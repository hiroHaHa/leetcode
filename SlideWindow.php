<?php
// 滑动窗口相关

class SlideWindow
{
	// 76.最小覆盖子串,
	public function minWindow($s, $t)
	{
		$arrNeed = $arrWindow = [];

		$slen = strlen($s);
		$tlen = strlen($t);

		for ($i = 0; $i < $tlen; $i++) {
			$elem = $t[$i];
			if (isset($arrNeed[$elem])) {
				$arrNeed[$elem]++;
			} else {
				$arrNeed[$elem] = 1;
			}
		}

		$left = 0;
		$right = 0;
		$valid = 0;

		$start = 0;
		$len = PHP_INT_MAX;

		while ($right < $slen) {

			$c = $s[$right];
			$right++; // 右移窗口

			if (isset($arrNeed[$c])) {
				$arrWindow[$c]++;
				if ($arrWindow[$c] == $arrNeed[$c]) {
					$valid++; // 表示一个字符配对完毕
				}
			}

			// 表示所有所需字符配对完毕
			while ($valid == count($arrNeed)) {
	
				$newSubstrLen = $right - $left;
				$isExistSmallerSubstr = $newSubstrLen < $len;
				if ($isExistSmallerSubstr) {
					// 在这里更新最小覆盖子串
					$start = $left;
					$len = $newSubstrLen;
				}

				$d = $s[$left];
				$left++; // 左移动窗口

				$isNeedChar = isset($arrNeed[$d]);
				if ($isNeedChar) {
					if ($arrWindow[$d] == $arrNeed[$d]) {
						$valid--;
					}
					$arrWindow[$d]--;
				}

			}
		}

		return $len == PHP_INT_MAX ? '' : substr($s,$start,$len);
	}
}

$obj = new SlideWindow();

$s = "xxxxcxxaxxxxxaxxx";
$t = "aa";
$ret = $obj->minWindow($s,$t);
var_dump($ret);