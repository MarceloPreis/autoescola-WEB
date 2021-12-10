package autoescola;

import java.io.FileWriter;
import java.util.ArrayList;
import java.util.List;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import com.google.gson.reflect.TypeToken;
import java.lang.reflect.Type;

public class AlunoLista {
	
private List<Aluno> lista = new ArrayList<Aluno>();
	
	public List<Aluno> getLista() {
		return lista;
	}

	public void setLista(List<Aluno> lista) {
		this.lista = lista;
	}

	public void add(Aluno aluno) {
			if (lista.contains(aluno) == false) {
				lista.add(aluno);
			}
		
	}
	
	//public void alterarNome(int index, String cpf) {
		//lista.get(index).setCpf(cpf);
		
	//}
	
	public void gravar() {
		GsonBuilder builder = new GsonBuilder();
	    Gson gson = builder.create();
	    FileWriter writer;
		try {
			writer = new FileWriter("lista_JSON/json/listaaluno.json");
			writer.write(gson.toJson(lista));
		    writer.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}
	
	public List<Aluno> ler() {
	    BufferedReader bufferedReader = null;
		try {
			bufferedReader = new BufferedReader(new FileReader("lista_JSON/json/listaaluno.json"));
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}
	    Type listType = new TypeToken<ArrayList<Aluno>>(){}.getType();
	    lista = new ArrayList<Aluno>();
	    lista = new Gson().fromJson(bufferedReader, listType);
	    return lista;
	}

	
	

}
