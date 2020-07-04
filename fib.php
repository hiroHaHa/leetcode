<?php

// 斐波拉切
/* 
斐波那契数，通常用 F(n) 表示，形成的序列称为斐波那契数列。该数列由 0 和 1 开始，后面的每一项数字都是前面两项数字的和。
也就是：
F(0) = 0,   F(1) = 1
F(N) = F(N - 1) + F(N - 2), 其中 N > 1.
给定 N，计算 F(N)。

示例 1：
输入：2
输出：1
解释：F(2) = F(1) + F(0) = 1 + 0 = 1.

示例 2：
输入：3
输出：2
解释：F(3) = F(2) + F(1) = 1 + 1 = 2.

*/

class Fibla
{
	// 递归解法：time:O(2^n),space:O(n),内存中使用的堆栈大小。
	public function fib($n)
	{
		if ($n == 0) return 0; 
		if ($n == 1 || $n == 2) return 1;
		return $this->fib($n - 1) + $this->fib($n - 2);
	}

	// 自顶向下：加入备忘录优化，避免重复计算
	// time:O(n),space:O(n),内存中使用的堆栈大小。
	static $arrmemo = [];
	public function fibmemo($n)
	{
		if ($n == 0) return 0; 

		if ($n == 1 || $n == 2) return 1;

		return $this->_memoize($n);
	}

	private function _memoize($n)
	{
		if (isset(self::$arrmemo[$n])) {
			return self::$arrmemo[$n];
		} 
		self::$arrmemo[$n] = $this->fibmemo($n - 1) + $this->fibmemo($n - 2);
		return self::$arrmemo[$n];
	}

	// 自底向上：动态规划，dp数组解法
	// time:O(n),space:O(n)
	public function fibdp($n)
	{
		$dp[0] = 0;
		$dp[1] = 1;

		for ($i = 2; $i <= $n; $i++) {
			$dp[$i] = $dp[$i - 1] + $dp[$i - 2];
		}

		return $dp[$n];
	}

	// 自底向上迭代
	// time:O(n),space:O(1)
	public function fibiter($n)
	{
		if ($n <= 1) return $n;

		$prev2 = 0;
		$prev1 = 1;
		$curr = 0;

		for ($i = 2; $i <= $n; $i++) {
			$curr = $prev1 + $prev2;
			$prev2 = $prev1;
			$prev1 = $curr;
		}

		return $curr;
	}

}