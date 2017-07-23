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

		//二、绑定参数  bindParam(引用传参) 或者bindValue(引用传值)   
		// $statement->bindParam(':title',$t);
		// $statement->bindParam(':content',$c);
		// $statement->bindParam(':images',$i);

		//三、准备参数
		// $t = $_GET['title'];
		// $c = $_GET['content'];
		// $i = $_GET['images'];

		//四、执行预处理   可以直接传关联数组执行(便于表单提交的数据)
		// $statement->execute();
		$statement->execute($_POST);

		echo $statement->rowCount();

		//执行DQL返回的结果
		$statement->fetch();//从结果集中获取下一行 
		$statement->fetchAll();//返回一个包含结果集中所有行的数组 

	}catch(PDOException $e){
		echo $e->getMessage();
	}