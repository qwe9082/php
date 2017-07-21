<?php
	/*
	**pdo事务处理流程
	**事务处理mysql引擎必须是innodb
	*/
	header("Content-Type:text/html;charset=utf-8");

	try{
		//实例化pdo类
		$pdo = new PDO('mysql:host=localhost;dbname=mysql','root','123456',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		
		//一、开启事务 begin;
		$pdo->beginTransaction(); 

		//二、执行sql语句
		$eff = $pdo->exec("update zhanghu set money=money-1000 where id=3;");
		if($eff==0){
			throw new PDOException('没有数据修改1');
		}

		$eff = $pdo->exec("update zhanghu set money=money+1000 where id=4;");
		if($eff==0){
			throw new PDOException('没有数据修改2');
		}

		//三、提交或者回滚  commit
		$pdo->commit();

		$pdo = null;

	}catch(PDOException $e){
		//三、有异常回滚  rollback
		// $pdo->rollBack();
		echo $e->getMessage();
	}