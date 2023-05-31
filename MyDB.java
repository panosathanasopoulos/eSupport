package com.example.servingwebcontent;

import java.sql.*;


public class MyDB {
	 public static Connection con;
	
    MyDB()
    {
    	System.out.println("test");
    	try{
		Class.forName("com.mysql.cj.jdbc.Driver"); 
		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/dbsystat","root",""); 
		
    	}
		catch(Exception e)
		{ 
			System.out.println(e);
		}  
    }
}