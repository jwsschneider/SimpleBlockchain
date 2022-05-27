<?php
namespace includes;


class Blockchain
{
    
    public $bc;
    public $xml;
    
    function __construct() {
        $this->bc = array();
        $this->xml = new \SimpleXMLElement("<blocks></blocks>");
    }
    
    function load_blockchain($filename) {
        
        $blockchain = new Blockchain();
        
        $blockchain->xml = simplexml_load_file($filename) or die("Error: Cannot load blockchain XML");
        
        
        
        foreach ($blockchain->xml->block as $current_block_xml) {
            
            $current_block = new \Block();
            $current_block->id = $current_block_xml->id;
            $current_block->timestamp = $current_block_xml->timestamp;
            $current_block->last_hash = $current_block_xml->last_hash;
            $current_block->hash = $current_block_xml->hash;
            $current_block->ip = $current_block_xml->ip;
            $current_block->platform = $current_block_xml->platform;
            $current_block->browser = $current_block_xml->browser;
            
                       
            array_push($blockchain->bc, $current_block);
            
            
        } // foreach
        
        
        return $blockchain;
        
    }
    
    function save_blockchain($filename) {
        
        $this->xml = new \SimpleXMLElement("<blocks></blocks>"); // wipe the DB clean
                        
        foreach ($this->bc as $block) {
            
            $block_xml = $this->xml->addChild("block");
            $block_xml->addChild("id", $block->id);
            $block_xml->addChild("timestamp", $block->timestamp);
            $block_xml->addChild("last_hash", $block->last_hash);
            $block_xml->addChild("hash", $block->hash);
            $block_xml->addChild("ip", $block->ip);
            $block_xml->addChild("platform", $block->platform);
            $block_xml->addChild("browser", $block->browser);
                        
        } // foreach
        
        $this->xml->asXML($filename) or die("Error: Cannot save blockchain XML");
    }
    
    function add_block($block) {
        
        array_push($this->bc, $block);
        
    }
    
    function print_blocks() {
        print_r($this->xml);
    }
    
    function print_blocks_html() {
        
        $index = count($this->bc);
        
        while ($index) {
            $block = $this->bc[--$index];
       
                print_r("
        
                    <div class=WordSection1>
                    
                    <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
                     style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-padding-alt:
                     0in 5.4pt 0in 5.4pt;mso-border-insideh:none;mso-border-insidev:none'>
                     <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>Block
                      ID # ".$block->id."</span><o:p></o:p></b></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><o:p>&nbsp;</o:p></b></p>
                      </td>
                     </tr>
                     <tr style='mso-yfti-irow:1'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#D9D9D9;mso-background-themecolor:
                      background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>Timestamp</span></b><span
                      style='color:black;mso-color-alt:windowtext'> = </span> ".$block->timestamp."</p>
                      </td>
                     </tr>
                     <tr style='mso-yfti-irow:2'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#F2F2F2;mso-background-themecolor:
                      background1;mso-background-themeshade:242;padding:0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>IP Address</span></b><span
                      style='color:black;mso-color-alt:windowtext'> = </span>".$block->ip."</p>
                      </td>
                     </tr>
                     <tr style='mso-yfti-irow:3'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#D9D9D9;mso-background-themecolor:
                      background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>Platform</span></b><span
                      style='color:black;mso-color-alt:windowtext'> = </span>".$block->platform."</p>
                      </td>
                     </tr>
                     <tr style='mso-yfti-irow:4'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#F2F2F2;mso-background-themecolor:
                      background1;mso-background-themeshade:242;padding:0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>Browser</span></b><span
                      style='color:black;mso-color-alt:windowtext'> = </span>".$block->browser."</p>
                      </td>
                     </tr>
                     <tr style='mso-yfti-irow:5'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#D9D9D9;mso-background-themecolor:
                      background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>Block’s
                      HASH</span></b><span style='color:black;mso-color-alt:windowtext'> = </span>".$block->hash."</p>
                      </td>
                     </tr>
                     <tr style='mso-yfti-irow:6;mso-yfti-lastrow:yes'>
                      <td width=102 valign=top style='width:76.25pt;background:#00B0F0;padding:
                      0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                      </td>
                      <td width=522 valign=top style='width:391.25pt;background:#F2F2F2;mso-background-themecolor:
                      background1;mso-background-themeshade:242;padding:0in 5.4pt 0in 5.4pt'>
                      <p class=MsoNormal><b><span style='color:black;mso-color-alt:windowtext'>Previous
                      Block’s HASH</span></b><span style='color:black;mso-color-alt:windowtext'> = </span>".$block->last_hash."</p>
                      </td>
                     </tr>
                    </table>
                    
                    <p class=MsoNormal><o:p>&nbsp;</o:p></p>
                    
                    </div>
        
        
                ");
        } // for each;
    }
    

    
}

