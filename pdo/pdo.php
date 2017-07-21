<?php
	/*使用pdo连接数据库的一个例子，以及复习mysql命令*/
	try{
		//设置异常类型   //默认静至模式 PDO::ERRMODE_SILENT   //警告模式 PDO::ERRMODE_WARNING   //异常处理模式PDO::ERRMODE_EXCEPTION
		$opt = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
		//一：实例化pdo类
		$pdo = new PDO('mysql:host=localhost;dbname=mysql','root','123456',$opt);

		/*MYSQL常用命令
		1.进入mysql   mysql -uroot -p123456 myboke
		2.显示所有库   show databases
		3.使用库   use myboke(表名)
		4.显示所有表   show tables
		5.查看表结构  desc myboke(表名)
		6.增加字段  alter table table_name add column column_name type default value;//例子：alter table myboke add column publish_house varchar(10) default "";
		7.更改字段  alter table table_name change sorce_col_name dest_col_name type default value; source_col_name指原来的字段名称,dest_col_name;//例子：alter table myboke change IsMobile IsTelphone int(3) unsigned default 1;
		8.删除字段  alter table myboke drop column 列名;
		9.修改主键  alter myboke(表名) primary key title(字段名) 
		10.清空表  delete from myboke(表名) || truncate table myboke(表名)     不带where的delete可以清空表
		11.导入数据 load data infile”file_name” into table table_name;//例子：load data infile”/home/mzc/temp/tempbad.txt” into table pad;
		12.导出数据  select statment into outfile”dest_file”;//例子：select cooperatecode,createtime from publish limit 10 into outfile”/home/mzc/temp/tempbad.txt”;


	    MYSQL操作
	    1.增  insert into myboke(表名)(title,content,images) values(1,'this is title','content','1.png')
	    2.删  delete from myboke(表名) where id=1(条件)
	    3.改  uptate myboke(表名) set title='new title'(值) where id=1(条件)
	    4.查  select *(查找对象) from where id=1(条件)


		/*创建表
		create table myboke(
		   id INT NOT NULL AUTO_INCREMENT,
		   title VARCHAR(100) NOT NULL,
		   content VARCHAR(400) NOT NULL,
		   images VARCHAR(400) NOT NULL,
		   PRIMARY KEY ( id )
		);

		create table zhanghu(
			id int unsigned not null auto_increment primary key,
			name varchar(32),
			money int
		)engine=innodb default charset=utf8;
		*/

		//二：设置字符集
		$pdo->query('set names utf8');

		//三：sql语句
		$sql = "insert into myboke(title,content,images) values('title1','pdostate','1.png')";

		//四：执行sql语句exec 或者 query
		//exec执行DML   query执行DQL
		//DML:数据操作语言包括insert，update，delete   DQL：查询语句select    DDL：数据定义语言包括create table   
		//DCL：数据控制语言1) GRANT：授权。2) 2) ROLLBACK：回滚。3) COMMIT：提交
		$pdo->exec($sql);//返回受影响条数

		$pdo->lastInsertid();//返回最后插入行的ID或序列值 

		//五：关闭连接
		$pdo = null;
	} catch(PDOException $e){
		//PDOException  pdo异常类
		//getMessage:获取异常消息内容     getCode():错误代码
		echo '连接数据库失败：'.$e->getMessage();
	}