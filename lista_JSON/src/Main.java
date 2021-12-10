package autoescola;

public class Main {

			public static void main(String[] args) {
				
				InstrutorLista l = new InstrutorLista();
				
				Instrutor a = new Instrutor();
				a.setNome("Curvello");
				a.setCpf("123123");
				a.setSalario(2500);
				l.add(a);
				
				a = new Instrutor();
				a.setCpf("741258");
				a.setNome("Nara");
				a.setSalario(3200);
				l.add(a);
				
				l.gravar();
				
				l = new InstrutorLista();
				
				l.setLista(l.ler());
				
			    for (Pessoa p : l.getLista()) {
					System.out.println(p);
				}   
			 }	
		}
