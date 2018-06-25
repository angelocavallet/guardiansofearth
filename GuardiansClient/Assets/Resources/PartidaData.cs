using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using System.Text;

public class PartidaData : MonoBehaviour {

	public static PartidaData partidaData; 

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

	void Awake(){
		if (partidaData == null) {
			DontDestroyOnLoad (gameObject);
			partidaData = this;

		} else if (partidaData != this) {
			Destroy (gameObject);
		}
	}


	public void getPartidaData(JsonModel.Partida partida){
	
		id = partida.id;
		status = partida.status;
		baraJog1 = partida.baraJog1;
		vidaJogador1 = partida.vidaJogador1;
		jog1Id = partida.jog1Id;
		jogador1 = partida.jogador1;
		baraJog2 = partida.baraJog2;
		vidaJogador2 = partida.vidaJogador2;
		jog2Id = partida.jog2Id;
		jogador2 = partida.jogador2;
		rodadaId = partida.rodadaId;
		jogador1Pronto = partida.jogador1Pronto;
		jogador2Pronto = partida.jogador2Pronto;
	
	}

	public void sairPartida(){

		id = 0;
		status = null;
		baraJog1 = 0;
		vidaJogador1 = 0;
		jog1Id = 0;
		jogador1 = null;
		baraJog2 = 0;
		vidaJogador2 = 0;
		jog2Id = 0;
		jogador2 = null;
		rodadaId = 0;
		jogador1Pronto = 0;
		jogador2Pronto = 0;

	}
}
