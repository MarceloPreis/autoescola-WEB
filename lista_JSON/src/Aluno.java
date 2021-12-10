package autoescola;

public class Aluno extends Pessoa {
	
	private Endereco endereco;

	@Override
	public String toString() {
		StringBuilder builder = new StringBuilder();
		builder.append("Aluno [endereco=");
		builder.append(endereco);
		builder.append(", toString()=");
		builder.append(super.toString());
		builder.append("]");
		return builder.toString();
	}

	
	
	
	

}
