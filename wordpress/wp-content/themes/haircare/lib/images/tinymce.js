function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertshortcodes() {
	
	var tagtext;
	
	var shortcodes_panel = document.getElementById('shortcodes_panel');
	
if (shortcodes_panel.className.indexOf('current') != -1) {
		var kayashortcode = document.getElementById('kayashortcodetag').value;
		switch(kayashortcode)
{
case 0:
 	tinyMCEPopup.close();
  break;
  
 
	case 'button_small':
	tagtext="["+kayashortcode + "  url=\"#\"  color=\"small-blue\"  desc=\"desc\"] Insert Button Text <span> </span> [/" + kayashortcode + "]";
	break;
  
	case 'button_big':
	tagtext="["+kayashortcode + "  url=\"#\"  color=\"big-blue\"  desc=\"desc\"] Insert Button Text <span> </span> [/" + kayashortcode + "]";
	break;  
  
	case 'dropcap':
 	tagtext="["+kayashortcode + " ] insert text [/" + kayashortcode + "]";
	break;
	
	case "toggle_content":
		tagtext = "["+ kayashortcode + "  heading=\"Toggle Heading\"]  Add your content here [/" + kayashortcode + "]";
	break;
	
	case "tabs":
	tagtext="["+ kayashortcode + " tab1=\"Tab 1 Title\" tab2=\"Tab 2 Title\" tab3=\"Tab 3 Title\"]<br /><br />[tab]Insert tab 1 content here[/tab]<br />[tab]Insert tab 2 content here[/tab]<br />[tab]Insert tab 3 content here[/tab]<br /><br />[/" + kayashortcode + "]";
	break;
	
	case 'clear':
 	tagtext="["+kayashortcode + " ] &nbsp; [/" + kayashortcode + "]";
	break;
	
	case 'divider':
 	tagtext="["+kayashortcode + " ] &nbsp; [/" + kayashortcode + "]";
	break;
	
	case 'announcement':
 	tagtext="["+kayashortcode + " ] Add your content here [/" + kayashortcode + "]";
	break;
	case "kaya_table":
	tagtext = "["+ kayashortcode + "  style= \" red \"]<table width=\"100%\"><br /><tbody><br /><tr><br /><th width=\"30%\">Heading 1</th width=\"30%\"><br /><th width=\"30%\">Heading 2</th width=\"30%\"><br /><th width=\"30%\">Heading 3</th><br /><th>Heading 4</th><br /></tr><br /><tr><br /><td>Division 1</td><br /><td>Division 2</td><br /><td>Division 3</td><br /><td>Division 4</td><br /></tr><br /><tr><br /><td>Division 1</td><br /><td>Division 2</td><br /><td>Division 3</td><br /><td>Division 4</td><br /></tr><br /></tbody><br /></table><br />[/" + kayashortcode + "]";
break;

// shortcode columns starts ==================================================
	case "column5":
	tagtext = "[column5]<br /> Insert you content here <br />[/column5]<br /><br />[column5]<br /> Insert you content here 1<br />[/column5]<br /><br />[column5]<br /> Insert you content here <br />[/column5]<br /><br />[column5]<br /> Insert you content here <br />[/column5]<br /><br />[column5_last]<br /> Insert you content here <br />[/column5_last]<br />";
	break;
	
	case "column5_4":
	tagtext = "[column5_4]<br /> Insert you content here <br />[/column5_4]<br /><br />[column5_last]<br /> Insert you content here <br />[/column5_last]<br />";
	break;
	
	case "column4":
	tagtext = "[column4]<br /> Insert you content here <br />[/column4]<br /><br />[column4]<br /> Insert you content here <br />[/column4]<br /><br />[column4]<br /> Insert you content here <br />[/column4]<br /><br />[column4_last]<br /> Insert you content here <br />[/column4_last]<br />";
	 break;
	
	
	case "column3":
	tagtext = "[column3]<br /> Insert you content here<br />[/column3]<br /><br />[column3]<br /> Insert you content here <br />[/column3]<br /><br />[column3_last]<br /> Insert you content here <br />[/column3_last]<br />";
	break;
	 
	case "column2":
	tagtext = "[column2]<br /> Insert you content here <br />[/column2]<br /><br />[column2_last]<br /> Insert you content here <br />[/column2_last]<br />";
	break;
 
	case "column1":
	tagtext = "[column1]<br /> Insert you content here <br />[/column1]";
	break;
 
	case "column3_2":
	tagtext = "[column3_2]<br /> Insert you content here <br />[/column3_2]<br /><br />[column3_last]<br /> Insert you content here <br />[/column3_last]";
	break;
 
	case "column4_3":
	tagtext = "[column4_3]<br /> Insert you content here <br />[/column4_3]<br /><br />[column4_last]<br /> Insert you content here <br />[/column4_last]";
	break;
	
// shortcode columns end ==================================================	

	case 'quotes':
 	tagtext="["+kayashortcode + " ] Insert you content here [/" + kayashortcode + "]";
	break;
	
	
	case "OrderedList":
	tagtext = "[OrderedList] <br> <li> Insert your content here </li> <br> <li> Insert your content here </li> <br> <li> Insert your content here </li> <br> [/OrderedList]";
	break;
	
	case "UnOrderlist":
	tagtext = "[UnOrderlist] <br> <li> Insert your content here </li> <br> <li> Insert your content here </li> <br> <li> Insert your content here </li> <br> [/UnOrderlist]";
	break;
	
	case "testimonial":
		tagtext = "["+ kayashortcode + "  title=\"Testimonial Title\" author_image=\" client image url\" link=\"#\" ]  Add the Testimonial content here [/" + kayashortcode + "]";
	break;
	
	case "teaserbox":
		tagtext = "["+ kayashortcode + "   icon=\" icon url  \" title= \" Teaser Title \" link=\"#\" ]  Add the Teaser content here [/" + kayashortcode + "]";
	break;
	
	case "social":
		tagtext = "["+ kayashortcode + " icon=\" icon url  \" link=\"#\" ]  [/" + kayashortcode + "]";
	break;
		
	
  
  default:
tagtext="["+kayashortcode + "] Insert your  content here text[/" + kayashortcode + "]";
}
}
// portfolio panel
var kaya_portfolio = document.getElementById('portfolio_panel');

	if (kaya_portfolio.className.indexOf('current') != -1) {
		var portfolio_tag = document.getElementById('portfolio_tag').value;
    	var max_columns = document.getElementById('max_columns').value;
		var images_pages = document.getElementById('images_pages').value;

var title_show = getCheckedValue(document.getElementsByName('title_show'));
var desc_show = getCheckedValue(document.getElementsByName('desc_show'));
var images_links = getCheckedValue(document.getElementsByName('images_links'));
		if (portfolio_tag != 0 )
			tagtext = "[portfolio id=" + portfolio_tag + " images=" + images_pages + " column=" + max_columns + " style=" + images_links + "  title=" + title_show + " desc=" + desc_show + "]";
		else
			tinyMCEPopup.close();
	}
	
	

if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}