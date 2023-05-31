package com.example.servingwebcontent;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;



public class Admin {
	public String username;
	public String password;
	public int id;
	
	
	public Admin()
	{
		this.id=0;
		this.username="";
		this.password="";
	}
	
	public void set(int id1,  String u, String p)
	{
		this.id=id1;
		this.username=u;
		this.password=p;
	}
	
	static String isfound(String u,String p)
	{
		try {
			String sql="select * from admin where  username='"+u+"' and password='"+p+"'";
			System.out.println(sql);
			Statement stmt=MyDB.con.createStatement();  
			ResultSet rs=stmt.executeQuery(sql);  
			
				rs.next();
				int id=rs.getInt("id");
				String usr=rs.getString("username");
				stmt.close();
				return "{\"id\":"+id+", \"username\":\""+usr+"\"}";
				
				
			}
			catch(Exception e)
			{
				return "{\"error\":1}";
			}
		
	}
	
	static String getAll()
	{
		try {
			String sql="select * from admin ";
			System.out.println(sql);
			Statement stmt=MyDB.con.createStatement();  
			ResultSet rs=stmt.executeQuery(sql);  
			String s="";
			String c="";
				while(rs.next()) {
				int id=rs.getInt("id");
				
				
				String usr=rs.getString("username");
				s=s+c+"{\"id\":"+id+", \"username\":\""+usr+"\"}";
				c=",";
				}
				stmt.close();
				return "["+s+"]";
				
				
			}
			catch(Exception e)
			{
				return "{\"error\":1}";
			}
		
	}
	
	static Admin foundT(int id1)
	{
		try {
			String sql="select * from admin where  id='"+id1+"'";
			System.out.println(sql);
			Statement stmt=MyDB.con.createStatement();  
			ResultSet rs=stmt.executeQuery(sql);  
			
				rs.next();
				int id=rs.getInt("id");
				
				String usr=rs.getString("username");
				Admin T=new Admin();
				T.set(id,usr,"");
				stmt.close();
				return T;
				
				
			}
			catch(Exception e)
			{
				return null;
			}
		
	}
	
	static String foundId(String id1)
	{
		try {
			String sql="select * from admin where  id="+id1;
			System.out.println(sql);
			Statement stmt=MyDB.con.createStatement();  
			ResultSet rs=stmt.executeQuery(sql);  
			
				rs.next();
				int id=rs.getInt("id");
				
				String usr=rs.getString("username");
				String pss=rs.getString("password");
				stmt.close();
				return "{\"id\":"+id+", \"username\":\""+usr+"\", \"password\":\""+pss+"\"}";
				
				
			}
			catch(Exception e)
			{
				return "{\"error\":1}";
			}
		
	}
	
	
	boolean insertDb()
	{
		try {
		String sql="insert into admin set  username='"+this.username+"', password='"+this.password+"'";
		Statement stmt=MyDB.con.createStatement();  
		stmt.execute(sql);
		System.out.println(sql);
		stmt.close();
		return true;
		}
		catch(Exception e)
		{
			return false;
		}
	}

	boolean updateDb()
	{
		try {
		String sql="update admin set  username='"+this.username+"', password='"+this.password+"' where id="+this.id;
		Statement stmt=MyDB.con.createStatement();  
		stmt.execute(sql);
		System.out.println(sql);
		stmt.close();
		return true;
		}
		catch(Exception e)
		{
			return false;
		}
	}
	
	boolean delDb()
	{
		try {
		String sql="delete from admin where id="+this.id;
		Statement stmt=MyDB.con.createStatement();  
		stmt.execute(sql);
		System.out.println(sql);
		stmt.close();
		return true;
		}
		catch(Exception e)
		{
			return false;
		}
	}
	
	
}