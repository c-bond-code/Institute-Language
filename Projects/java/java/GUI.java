import java.awt.Desktop;
import java.io.File;
import java.io.IOException;

import javax.swing.DefaultListModel;

public class GUI extends javax.swing.JFrame {
	
	/**
	 * author Clayton Bond
	 */
	
	private static final long serialVersionUID = 1L;
	private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JList<String> jList1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTextField jSearch; 

    public GUI() {
        initComponents();
        
    }                         
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jSearch = new javax.swing.JTextField();
        jScrollPane1 = new javax.swing.JScrollPane();
        jList1 = new javax.swing.JList<>();
        jLabel2 = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        //setBounds(new java.awt.Rectangle(400, 400, 400, 400));
        getContentPane().setLayout(null);

        jLabel1.setFont(new java.awt.Font("Hiragino Sans", 0, 18)); 
        jLabel1.setForeground(new java.awt.Color(255, 255, 255));
        jLabel1.setText("W I K I P E D I A");
        jLabel1.setToolTipText("");
        jLabel1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                try {
					jLabel1MouseClicked(evt);
				} catch (InterruptedException e) {
					e.printStackTrace();
				} catch (IOException e) {
					e.printStackTrace();
				}
            }
        });
        getContentPane().add(jLabel1);
        jLabel1.setBounds(90, 122, 143, 28);

        jSearch.setToolTipText("");
        jSearch.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                try {
					jSearchActionPerformed(evt);
				} catch (InterruptedException e) {
					e.printStackTrace();
				} catch (IOException e) {
					e.printStackTrace();
				}
            }
        });
        getContentPane().add(jSearch);
        jSearch.setBounds(90, 156, 228, 26);

        jList1.setFont(new java.awt.Font("Hiragino Kaku Gothic ProN", 2, 12)); 
        jList1.setForeground(new java.awt.Color(102, 102, 102));
        //jList1.setModel(new javax.swing.AbstractListModel<String>() {
            //String[] strings = { "Big O Notation", "Quicksort", "Heap Sort", "Red Black Tree", "Russia" };
           // public int getSize() { return strings.length; }
           // public String getElementAt(int i) { return strings[i]; }
       // });
        jList1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mousePressed(java.awt.event.MouseEvent evt) {
                try {
					jList1MousePressed(evt);
				} catch (IOException e) {
					e.printStackTrace();
				}
            }
        });
        jScrollPane1.setViewportView(jList1);

        getContentPane().add(jScrollPane1);
        jScrollPane1.setBounds(370, 70, 217, 194);

        jLabel2.setIcon(new javax.swing.ImageIcon("clouds.jpg")); // NOI18N
        jLabel2.setText("jLabel2");
        getContentPane().add(jLabel2);
        jLabel2.setBounds(-120, -230, 820, 600);

        pack();
        setLocationRelativeTo(null);
    }                       

    @SuppressWarnings("unchecked")
	private void jSearchActionPerformed(java.awt.event.ActionEvent evt) throws InterruptedException, IOException {                                        
    	if(WikipediaSearch.filePaths == null) {
    		WikipediaSearch.filePaths = FileSearch.getPath();
    	}
    	
        int[] index = WikipediaSearch.run(jSearch.getText());
        
        @SuppressWarnings("rawtypes")
		DefaultListModel model = new DefaultListModel();
        
        for(int i = 0; i < 10; i++) {
        	String item = WikipediaSearch.reducedNames.get(index[i]);
        	if(item.length() > 30) {
        		model.addElement(item.substring(0, 29) + "...");
        	}
        	else {
        		model.addElement(item);
        	}
        }
        jList1.setModel(model);
        jSearch.setText("");
    }                                       

    private void jLabel1MouseClicked(java.awt.event.MouseEvent evt) throws InterruptedException, IOException {     
        WikipediaSearch.filePaths = FileSearch.getPath();
    }                                    

    private void jList1MousePressed(java.awt.event.MouseEvent evt) throws IOException {                                    
       
    	File htmlFile = new File(WikipediaSearch.filePaths.get(WikipediaSearch.getIndex()[jList1.getSelectedIndex()]));
		Desktop.getDesktop().browse(htmlFile.toURI());
		
    }                                   

    public static void main(String args[]) {
    	java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new GUI().setVisible(true);
            }
        });
    }
                       
}
