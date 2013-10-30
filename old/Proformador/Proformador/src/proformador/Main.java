/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package proformador;

import javax.swing.JFrame;
import javax.swing.SwingUtilities;
import javax.swing.UIManager;

/**
 *
 * @author Daniel Kennedy
 */
public class Main {

    public static String[] SERVER={"localhost", "proformador", "root", "3141516"};
    static String PATH = "http://" + SERVER[0] + "/proformas/";
    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        JFrame.setDefaultLookAndFeelDecorated(true);
        try {
                    UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
                } catch (Exception e) {
                    System.out.println(e);
                }
        SwingUtilities.invokeLater(new Runnable() {

            public void run() {
                login log = new login();
                log.setVisible(true);
            }
        });
    }

}
