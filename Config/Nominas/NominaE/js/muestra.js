			
		if (a=='nuevo_e')
		{
			$("#nuevo_e").show();
			$("#lista_e").hide();
			$("#modifica_e").hide();
			$("#elimina_e").hide();
		}

		if (a=='lista_e')
		{	$("#nuevo_e").hide();
			$("#lista_e").show();
			$("#modifica_e").hide();
			$("#elimina_e").hide();
		}
		if (a=='modifica_e')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
			$("#modifica_e").show();
			$("#elimina_e").hide();
		}
		if (a=='elimina_e')	
		{			
			$("#nuevo_e").hide();
			$("#lista_e").hide();
			$("#modifica_e").hide();
			$("#elimina_e").show();
		}
	