<?php
	/*MYSQL预处理和pdostatement*/

	//MYSQL命令行预处理
	//一、设置占位符
	//prepare statement from 'update zhanghu set money=money+1000 where id=?';
	//二、定义变量
	//set @i=3;  
	//三、执行预处理
	//execute statement using @i;




	//pdo预处理  pdostatement
	try{
		//实例化pdo类
		$pdo = new PDO('mysql:host=localhost;dbname=mysql','root','123456',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		//设置字符集
		$pdo->exec('set names utf8');

		//开始预处理
		//一、创建预处理对象
		$statement = $pdo->prepare('insert into myboke(title,content,images) values(:title,:content,:images)');

		//二、绑定参数
		$statement->bindParam(':title',$t);
		$statement->bindParam(':content',$c);
		$statement->bindParam(':images',$i);

		//三、准备参数
		$t = 'state title';
		$c = 'state content';
		$i = 'state.png';

		//四、执行预处理
		$statement->execute();

	}catch(PDOException $e){
		echo $e->getMessage();
	}