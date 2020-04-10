/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projet;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author rami2
 */

public class DbConnection 
{
    private static DbConnection instance;
    private Connection connexion;
    private String url = "JDBC:mysql://localhost:3306/projet";
    private String user = "root";
    private String password = "";

    private DbConnection() {
        try {
            connexion = DriverManager.getConnection(url, user, password);
        } catch (SQLException ex) {
            System.out.println("Probleme de connexion");
        }
    }

    public static DbConnection getInstance() {
        if (DbConnection.instance == null) 
        {
            DbConnection.instance = new DbConnection();
        }
        return DbConnection.instance;
    }

    public Connection getConnexion() {
        return this.connexion;
    }
}
