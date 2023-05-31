package com.example.servingwebcontent;

import java.io.File;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.MultipartFile;

@Controller
public class MyController {
	
	@GetMapping("/")
	public String start( Model model) {
		
		return "index";
	}
	
	@GetMapping("/showpage2")
	public String page2( Model model) {
		
		return "page2";
	}
	

	@GetMapping("/getS")
	@ResponseBody
	public String getS(@RequestParam String id1) {
		Student s=Student.foundbyID(Integer.parseInt(id1));
		return s.toJSON();
		
		
	}
	
	
	@GetMapping("/getT")
	@ResponseBody
	public String getT(@RequestParam String id1) {
		
		String out=Teacher.foundId(id1);
		return out;
		
	}
	

	
	
	@RequestMapping(value = "/insertT", method = RequestMethod.POST)
	@ResponseBody
	public String newT(@RequestParam String nm, @RequestParam String usr, @RequestParam String pss, Model model) {
		
	   Teacher t=new Teacher();
	   t.setTeacher(0, nm, usr, pss);
	   if(t.insertDb()) return "1";
	   else return "0";
		
	    
	}
	
	@RequestMapping(value = "/insertA", method = RequestMethod.POST)
	@ResponseBody
	public String newA( @RequestParam String usr, @RequestParam String pss, Model model) {
		
	   Admin t=new Admin();
	   t.set(0, usr, pss);
	   
	   if(t.insertDb()) return "1";
	   else return "0";
		
	    
	}
	
	
	@RequestMapping(value = "/insertE", method = RequestMethod.POST)
	@ResponseBody
	public String insertE(@RequestParam String id1,@RequestParam String aitisi, @RequestParam String kath, @RequestParam String foreas, @RequestParam String email,  Model model) {
		
	   Epistoli l=new Epistoli();
	   Student S=Student.foundbyID(Integer.parseInt(id1));
	   
	   Teacher t=Teacher.foundT(Integer.parseInt(kath));
	   l.set(S, t, 0, aitisi, "", foreas, email);
	   if(l.insertDb()) return "1";
	   else return "0";
		
	    
	}
	
	
	

	@RequestMapping(value = "/insertS", method = RequestMethod.POST)
	@ResponseBody
	public String insertL(@RequestParam String nm, @RequestParam String am, @RequestParam String usr, @RequestParam String pss,  Model model) {
		
	   Student s=new Student();
	   s.set(0, nm,am,usr,pss);
	   
	   
	   if(s.insertDb()) return "1";
	   else return "0";
		
	    
	}
	
	@GetMapping(value = "/getallE")
	@ResponseBody
	public String getallE( @RequestParam String id1,  Model model) {
		
	   return Epistoli.getAll(Integer.parseInt(id1));
		
	    
	}
	
	
	@GetMapping(value = "/getallE2")
	@ResponseBody
	public String getallE2( @RequestParam String id1,  Model model) {
		
	   return Epistoli.getAll2(Integer.parseInt(id1));
		
	    
	}
	
	
	@GetMapping(value = "/getallS")
	@ResponseBody
	public String getallS(   Model model) {
		
	   return Student.getAll();
		
	    
	}
	
	@GetMapping(value = "/getallT")
	@ResponseBody
	public String getallT(  Model model) {
		
	   return Teacher.getAll();
		
	    
	}
	
	@GetMapping(value = "/getallA")
	@ResponseBody
	public String getallA(   Model model) {
		
	   return Admin.getAll();
		
	    
	}
	

	@GetMapping(value = "/delE")
	@ResponseBody
	public String delE( @RequestParam String id1,  Model model) {
		Epistoli l=new Epistoli();
		
		l.delDb(Integer.parseInt(id1));
	   return "1";
		
	    
	}
	
	
	@GetMapping(value = "/delS")
	@ResponseBody
	public String delS( @RequestParam String id1,  Model model) {
		Student l=new Student();
		l.set(Integer.parseInt(id1), "","","","");
		l.delDb();
	   return "1";
		
	    
	}
	
	
	@GetMapping(value = "/delT")
	@ResponseBody
	public String delT( @RequestParam String id1,  Model model) {
		Teacher l=new Teacher();
		l.setTeacher(Integer.parseInt(id1), "","","");
		l.delDb();
	   return "1";
		
	    
	}
	
	@GetMapping(value = "/delA")
	@ResponseBody
	public String delA( @RequestParam String id1,  Model model) {
		Admin l=new Admin();
		l.set(Integer.parseInt(id1), "","");
		l.delDb();
	   return "1";
		
	    
	}
	
	@GetMapping(value = "/accept")
	@ResponseBody
	public String accept( @RequestParam String id1,  Model model) {
		System.out.println("id1="+id1);
		Epistoli l=Epistoli.find(Integer.parseInt(id1));
		l.accept=1;
		l.updateDb(Integer.parseInt(id1));
	   return "1";
		
	    
	}
	
	@GetMapping(value = "/reject")
	@ResponseBody
	public String reject( @RequestParam String id1,  Model model) {
		Epistoli l=Epistoli.find(Integer.parseInt(id1));
		l.accept=2;
		l.updateDb(Integer.parseInt(id1));
	   return "1";
		
	    
	}
	
	
	@GetMapping(value = "/sendmail")
	@ResponseBody
	public String send_mail( @RequestParam String id1,  Model model) {
		Epistoli l=Epistoli.find(Integer.parseInt(id1));
		l.sendMail=1;
		l.updateDb(Integer.parseInt(id1));
	   return "1";
		
	    
	}
	
	
	@RequestMapping(value = "/updateT", method = RequestMethod.POST)
	@ResponseBody
	public String updateT(@RequestParam String id1, @RequestParam String nm, @RequestParam String usr, @RequestParam String pss, Model model) {
		
	   Teacher t=new Teacher();
	   t.setTeacher(Integer.parseInt(id1), nm, usr, pss);
	   if(t.updateDb()) return "1";
	   else return "0";
		
	    
	}
	
	@RequestMapping(value = "/updateS", method = RequestMethod.POST)
	@ResponseBody
	public String updateS(@RequestParam String id1, @RequestParam String am,@RequestParam String nm, @RequestParam String usr, @RequestParam String pss, Model model) {
		
	   Student t=new Student();
	   t.set(Integer.parseInt(id1), nm,am, usr, pss);
	   if(t.updateDb()) return "1";
	   else return "0";
		
	    
	}
	
	
	
	
	@RequestMapping(value = "/loginT", method = RequestMethod.POST)
	@ResponseBody
	public String loginT( @RequestParam String usr, @RequestParam String pwd, Model model) {
		
	   String out=Teacher.isfound(usr, pwd);
	   
	   return out;
	    
	}
	
	@RequestMapping(value = "/loginS", method = RequestMethod.POST)
	@ResponseBody
	public String loginS( @RequestParam String usr, @RequestParam String pss, Model model) {
		
	   String out=Student.isfound(usr, pss);
	   
	   return out;
	    
	}
	
	@RequestMapping(value = "/loginA", method = RequestMethod.POST)
	@ResponseBody
	public String loginA( @RequestParam String usr, @RequestParam String pwd, Model model) {
		
	   String out=Admin.isfound(usr, pwd);
	   
	   return out;
	    
	}
	
	
	@RequestMapping(value = "/uploadfile", method = RequestMethod.POST)
	@ResponseBody
	public String uloadA( @RequestParam MultipartFile file1, @RequestParam String id1, Model model) {
		model.addAttribute("file1", file1);
		 String fileName = file1.getOriginalFilename();
		    try {
		      file1.transferTo( new File("c:\\upload\\" + fileName));
		    } catch (Exception e) {
		      return "0";
		    } 
		    
		    Epistoli l=Epistoli.find(Integer.parseInt(id1));
		    l.file=fileName;
		    l.updateDb(Integer.parseInt(id1));
		    return "1";
	   
	 
	    
	}
	
	
	
	

}
