/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projet;

import java.sql.ResultSet;
import java.sql.SQLException;
import projet.user.UserService;

/**
 *
 * @author rami2
 */
public class test 
{
      public static void main(String[] args) 
  {
    UserService US=new UserService();
    try
    {
        ResultSet rs=US.selectelevesduparent(8);
        while (rs.next())
        {
            int id = rs.getInt("user.id");
            String prenom = rs.getString("user.prenom");
            String nom = rs.getString(" user.nom");
            int classe_id = rs.getInt("classe.id");
            int classe_niveau = rs.getInt("classe.niveau");
        
            System.out.format("%s, %s, %s, %s, %s\n", id, prenom, nom, classe_id, classe_niveau);
        }       
    }
    catch(SQLException e){}
  } 
    
}
