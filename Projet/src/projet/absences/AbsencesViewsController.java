/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projet.absences;

import java.io.IOException;
import java.net.URL;
import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
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

/**
 * FXML Controller class
 *
 * @author rami2
 */
public class AbsencesViewsController implements Initializable 
{
    @FXML
    private Button ajouter;
    @FXML
    private Button modifier;
    @FXML
    private Button supprimer;
    
    @FXML
    private TableView<Absence> table;
    @FXML
    private ObservableList<Absence> data;
    @FXML
    private TableColumn<Absence, Integer> col_id;
    @FXML
    private TableColumn<Absence, LocalDate> col_date;
    @FXML
    private TableColumn<Absence, Integer> col_heure_debut;
    @FXML
    private TableColumn<Absence, Integer> col_heure_fin;
    @FXML
    private TableColumn<Absence, Integer> col_enseignantid;
    @FXML
    private TableColumn<Absence, Integer> col_eleveid;
    @FXML
    private TableColumn<Absence, String> col_justification;
    @FXML
    private TableColumn<Absence, Boolean> col_etat;

    
    
    
    public void showAbsences()
    {
      AbsenceService AS=new AbsenceService();
      
      try
      {
       ResultSet rs= AS.fetchAbsences();
       while(rs.next())
       {
          int identifiant = rs.getInt("id");
          Date dte = rs.getDate("dateabs");
          String j = rs.getString("justification");
          int heured = rs.getInt("heuredebut");
          int heuref = rs.getInt("heurefin");
          boolean e = rs.getBoolean("etat");
          String ens_id = rs.getString("enseignant_id");
          String elv_id = rs.getString("eleve_id");
          LocalDate d=dte.toLocalDate();
          data.add(new Absence(identifiant, j, d, heured, heuref, e, ens_id, elv_id));
       }    
      }
      catch(SQLException e)
      {
      }
    }
    
    
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) 
    {
        data=FXCollections.observableArrayList();
        showAbsences();
        col_id.setCellValueFactory(new PropertyValueFactory<>("id"));
        col_eleveid.setCellValueFactory(new PropertyValueFactory<>("eleve_id"));
        col_enseignantid.setCellValueFactory(new PropertyValueFactory<>("enseignant_id"));
        col_justification.setCellValueFactory(new PropertyValueFactory<>("justification"));
        col_heure_debut.setCellValueFactory(new PropertyValueFactory<>("HeureDebut"));
        col_heure_fin.setCellValueFactory(new PropertyValueFactory<>("heureFin"));
        col_date.setCellValueFactory(new PropertyValueFactory<>("dateAbsence"));
        col_etat.setCellValueFactory(new PropertyValueFactory<>("etat"));
         
        table.setItems(null);
        table.setItems(data);
    }    

    @FXML
    public void ajouterAbsence(ActionEvent event) 
    {
      try
      {    
        FXMLLoader loader = new FXMLLoader(getClass().getResource("formajoutabsences.fxml"));
        Parent root = loader.load();
        FormajoutabsencesController Controller = loader.getController();
        //fermer current stage //
        Stage s = (Stage) ajouter.getScene().getWindow();
        s.close();
       
        //ouvrir nouvelle info//
        Stage stage = new Stage();
        stage.setScene(new Scene(root));
        stage.setTitle("Ajouter Absence");
        stage.show();
      }
      catch(IOException e)
      {
                  
      }   
    }

    @FXML
    public void ModifierAbsence(ActionEvent event) 
    {
      try
      {    
        FXMLLoader loader = new FXMLLoader(getClass().getResource("formmodifierabsence.fxml"));
        Absence A=(table.getSelectionModel().getSelectedItem());  
        Parent root = loader.load();
        FormmodifierabsenceController Controller = loader.getController();
        //fermer current stage //
        Stage s = (Stage) ajouter.getScene().getWindow();
        s.close();
       
        //envoyer info//
        Controller.envoyer(A);
        
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

    @FXML
    public void SupprimerAbsence(ActionEvent event) 
    {
        
    }
    
}
