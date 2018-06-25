using UnityEngine;
using System;

public class JsonModel : MonoBehaviour {
	[Serializable]
	public class Usuario
	{
		public string nome;
		public string email;
		public string senha;
	}

	[Serializable]
	public class Partida
	{
		public int id;
		public string status;
		public int baraJog1;
		public int vidaJogador1;
		public int jog1Id;
		public string jogador1;
		public int baraJog2;
		public int vidaJogador2;
		public int jog2Id;
		public string jogador2;
		public int rodadaId;
		public int jogador1Pronto;
		public int jogador2Pronto;
	}

	[Serializable]
	public class Rodada
	{
		public int id;
		public int partida;

		public int iniciativa1Jog1;
		public int iniciativa2Jog1;
		public int iniciativa3Jog1;
		public int guardaJog1;
		public int descartaJog1;
		public int jogador1Pronto;

		public int iniciativa1Jog2;
		public int iniciativa2Jog2;
		public int iniciativa3Jog2;
		public int guardaJog2;
		public int descartaJog2;
		public int jogador2Pronto;

	}
	[Serializable]
	public class Item
	{
		public int id;
		public int jogador;

	}
	[Serializable]
	public class Jogada
	{
		public int partida;
		public int iniciativa1;
		public int iniciativa2;
		public int iniciativa3;
		public int guarda;
		public int descarta;

	}
	[Serializable]
	public class Registro
	{
		public int sequencia;
		public int jog1Id;
		public int vidaJog1;
		public int ataqueJog1;
		public int defesaJog1;
		public int curaJog1;
		public int jog2Id;
		public int vidaJog2;
		public int ataqueJog2;
		public int defesaJog2;
		public int curaJog2;

	}
}


