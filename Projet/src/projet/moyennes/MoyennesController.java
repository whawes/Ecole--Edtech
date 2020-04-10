/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projet.moyennes;

import projet.*;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.event.Event;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.util.Callback;
import projet.moyennes.Moyenne;
import projet.moyennes.MoyenneService;
import projet.notes.Note;

/**
 *
 * @author rami2
 */
public class MoyennesController implements Initializable 
{   
    @FXML
    private TableView<Moyenne> table;
    @FXML
    private TableColumn<Moyenne, String> id;
    @FXML
    private TableColumn<Moyenne, String> trimestre;
    @FXML
    private TableColumn<Moyenne, String> eleve_Id;
    @FXML
    private TableColumn<Moyenne, String> matiere;
    @FXML
    private TableColumn<Moyenne, String> moyenne;
    @FXML
    private Button recalcul;
    @FXML
    private Button supprimer;
     
    @FXML 
    public void effacerMoyenne(ActionEvent Event)
    {
      MoyenneService MS=new MoyenneService();
      Moyenne M=new Moyenne();
      M=table.getSelectionModel().getSelectedItem();

      try
      {
        MS.effacerMoyenne(M);
        table.getItems().removeAll(table.getSelectionModel().getSelectedItem());
        data.clear();
        showMoyennes();  
      }
      catch(SQLException e)
      {
          
      }
    }
    
    @FXML
    public void recalculerMoyenne(ActionEvent Event)
    {
        MoyenneService MS=new MoyenneService();
        Moyenne M=new Moyenne();
        M=table.getSelectionModel().getSelectedItem();
        data.clear();
        try
        {    
            MS.recalculerMoyenne2(M);
            showMoyennes();
        }
        catch(SQLException e)
        {
        }
        
    }
    
    public void showMoyennes()
    {
      MoyenneService MS=new MoyenneService();
      
      try
      {
       ResultSet rs= MS.fetchMoyennes();
       while(rs.next())
       {
          int id = rs.getInt("id");
          int idtrimestre = rs.getInt("trimestre");
          String eleve_id = rs.getString("eleve_id");
          String matiere = rs.getString("matiere");
          double valeur = rs.getDouble("moyenne");
          String v=String.valueOf(valeur);
          data.add(new Moyenne(id, idtrimestre, valeur, eleve_id, matiere));
       }    
      }
      catch(SQLException e)
      {
      }
    }
     
    private ObservableList<Moyenne> data;
       
    @Override
    public void initialize(URL url, ResourceBundle rb) 
    {
      data=FXCollections.observableArrayList();
      showMoyennes();
      id.setCellValueFactory(new PropertyValueFactory<>("id"));
      trimestre.setCellValueFactory(new PropertyValueFactory<>("trimestre"));
      eleve_Id.setCellValueFactory(new PropertyValueFactory<>("eleve_id"));
      matiere.setCellValueFactory(new PropertyValueFactory<>("matiere"));
      moyenne.setCellValueFactory(new PropertyValueFactory<>("moyenne"));
        
      table.setItems(null);
      table.setItems(data);
    }    
    
}
