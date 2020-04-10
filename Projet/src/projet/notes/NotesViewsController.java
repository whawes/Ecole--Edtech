/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projet.notes;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;
import projet.moyennes.MoyenneService;
import projet.moyennes.MoyennesController;

/**
 *
 * @author rami2
 */
public class NotesViewsController implements Initializable 
{

    @FXML
    private TableView<Note> table;
    @FXML
    private TableColumn<Note, Integer> col_Id;
    @FXML
    private TableColumn<Note, String> col_type;
    @FXML
    private TableColumn<Note, Integer> col_trimestre;
    @FXML
    private TableColumn<Note, Integer> col_enseignantid;
    @FXML
    private TableColumn<Note, Integer> col_eleveid;
    @FXML
    private TableColumn<Note, Integer> col_matiere;
    @FXML
    private TableColumn<Note, Double> col_valeur;
    @FXML
    private Button modifier;
    @FXML
    private Button supprimer;
    @FXML
    private Button ajouter;
    @FXML
    private Button boutton_moyenne;
    
    private ObservableList<Note> data;
    
    
    @FXML 
    public void SupprimerNote(ActionEvent Event)
    {
      NoteService MS=new NoteService();
      Note N=new Note(table.getSelectionModel().getSelectedItem());  
      N=table.getSelectionModel().getSelectedItem();

      try
      {
        MS.supprimerNote(N);
        table.getItems().removeAll(table.getSelectionModel().getSelectedItem());
        data.clear();
        showNotes();  
      }
      catch(SQLException e)
      {
          
      }
    }
    
    @FXML
    public void envoyerajouternote(ActionEvent event) 
    {
      try
      {
        
        FXMLLoader loader = new FXMLLoader(getClass().getResource("AjouterNotesForm.fxml"));
        Parent root = loader.load();
        NotesFormController Controller = loader.getController();
        //fermer current stage //
        Stage s = (Stage) ajouter.getScene().getWindow();
        s.close();
       
        //ouvrir nouvelle info//
        Stage stage = new Stage();
        stage.setScene(new Scene(root));
        stage.setTitle("Ajouter Note");
        stage.show();
      }
      catch(IOException e)
      {
                  
      } 
    }
    
    @FXML
    public void envoyermoyenne(ActionEvent Event)
    {
        NoteService NS=new NoteService();
        MoyenneService MS=new MoyenneService();
        Note N=new Note(table.getSelectionModel().getSelectedItem());  
        N=table.getSelectionModel().getSelectedItem();
        try
        {
            ResultSet rs=NS.selectionnerNotesParEleveMatiereTrimestre(N);
            MS.insererMoyenne(N, rs);
        }
        catch(SQLException e)
        {
            
        }
          
        
        try
        {
          FXMLLoader loader = new FXMLLoader();
          FileInputStream fileInputStream = new FileInputStream(new File("src/projet/moyennes/Moyennes.fxml"));
          
          Parent root = loader.load(fileInputStream);
          MoyennesController Controller = loader.getController();
          
          Stage s = (Stage) boutton_moyenne.getScene().getWindow();
          s.close();
       
          Stage stage = new Stage();
          stage.setScene(new Scene(root));
          stage.setTitle("Affichage Moyennes");
          stage.show();  
       }
        
       catch(IOException e)
       {
                  
       }       
    }
   
    @FXML
    public void envoyermodifierNote(ActionEvent Event)
    {
      try
      {
        NoteService MS=new NoteService();
        Note N=new Note(table.getSelectionModel().getSelectedItem());  
        
        FXMLLoader loader = new FXMLLoader(getClass().getResource("ModifierNotesForm.fxml"));
        Parent root = loader.load();
        ModifierNotesFormController Controller = loader.getController();
        //fermer current stage //
        Stage s = (Stage) modifier.getScene().getWindow();
        s.close();
        
        //envoyer info//
        Controller.envoyer(N);
        
        //ouvrir nouvelle info//
        Stage stage = new Stage();
        stage.setScene(new Scene(root));
        stage.setTitle("Modification");
        stage.show();
      }
      catch(IOException e)
      {
                  
      }
    }
    
    public void showNotes()
    {
      NoteService NS=new NoteService();
      
      try
      {
       ResultSet rs= NS.fetchNotes();
       while(rs.next())
       {
          int id = rs.getInt("id");
          int idtrimestre = rs.getInt("id_trimestre");
          String type=rs.getString("type");
          String eleve_id = rs.getString("eleve_id");
          String enseignant_id = rs.getString("enseignant_id");
          String matiere = rs.getString("matiere");
          double valeur = rs.getDouble("valeur");
          String v=String.valueOf(valeur);
          data.add(new Note(id, type, idtrimestre, enseignant_id, eleve_id, matiere, valeur));
       }    
      }
      catch(SQLException e)
      {
      }
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb) 
    {
        data=FXCollections.observableArrayList();
        showNotes();
        col_Id.setCellValueFactory(new PropertyValueFactory<>("id"));
        col_trimestre.setCellValueFactory(new PropertyValueFactory<>("trimestre"));
        col_type.setCellValueFactory(new PropertyValueFactory<>("type"));
        col_eleveid.setCellValueFactory(new PropertyValueFactory<>("eleve_id"));
        col_enseignantid.setCellValueFactory(new PropertyValueFactory<>("enseignant_id"));
        col_matiere.setCellValueFactory(new PropertyValueFactory<>("matiere"));
        col_valeur.setCellValueFactory(new PropertyValueFactory<>("valeur"));
        
        table.setItems(null);
        table.setItems(data);
    }    
}
