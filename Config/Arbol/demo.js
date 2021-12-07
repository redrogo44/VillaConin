$(document).ready(function(){
	
	// first example
	$("#browser").treeview();
	
	// second example
	$("#navigation").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});
	
	// third example
	$("#red").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "cookie",
		toggle: function() {
			window.console && console.log("%o was toggled", this);
		}
	});
	
	// fourth example
	$("#black, #gray").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview-black"
	});

});
$(document).ready(function(){
	
	// first example
	$("#browser").treeview2();
	
	// second example
	$("#navigation").treeview2({
		persist: "location",
		collapsed: true,
		unique: true
	});
	
	// third example
	$("#red2").treeview2({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "cookie",
		toggle: function() {
			window.console && console.log("%o was toggled", this);
		}
	});
	
	// fourth example
	$("#black, #gray").treeview2({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview2-black"
	});

});