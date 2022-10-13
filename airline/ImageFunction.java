/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package airline;

import java.awt.Image;
import java.io.File;
import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.filechooser.FileNameExtensionFilter;

/**
 *
 * @author User
 */
public class ImageFunction {
    public ImageIcon resizePic (String ImagePath,byte[]BLOBpic, int wdth, int hgh){
        ImageIcon ico;
        if(ImagePath!=null){
            ico=new ImageIcon(ImagePath);
        }else{
            ico=new ImageIcon(BLOBpic);
        }
        Image img=ico.getImage().getScaledInstance(wdth, hgh, Image.SCALE_SMOOTH);
        ImageIcon i2=new ImageIcon(img);
        return i2;
    }
    
    public String Choose_image(JLabel lbl){
        String pth="";
        JFileChooser filec=new JFileChooser();
        filec.setCurrentDirectory(new File(System.getProperty("user.home")));
        FileNameExtensionFilter filefilter=new FileNameExtensionFilter("*.image","jpg","png");
        filec.setFileFilter(filefilter);
        
        int FileState=filec.showSaveDialog(null);
        if(FileState==JFileChooser.APPROVE_OPTION){
          File file=filec.getSelectedFile();
          pth=file.getAbsolutePath();
          lbl.setIcon(resizePic(pth,null,lbl.getWidth(), lbl.getHeight()));
        }
        return pth;
    }
    
}
