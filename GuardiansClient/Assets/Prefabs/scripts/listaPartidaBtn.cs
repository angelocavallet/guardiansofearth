using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class listaPartidaBtn : MonoBehaviour {

	public Button button;
	public Text nomeJog1;
	public Text jog1Pronto;
	public Text nomeJog2;
	public Text jog2Pronto;

	private JsonModel.Partida partida;
	private partidaScrollList scrollPartida;


	// Use this for initialization
	void Start () {
		button.onClick.AddListener (HandleClick);
		
	}


	public void Setup(JsonModel.Partida partidaAtual, partidaScrollList scrollPartidaAtual){

		partida = partidaAtual;

		if (partida.rodadaId != 0) {
			nomeJog1.text = partida.jogador1;
			nomeJog2.text = partida.jogador2;

			if (partida.jogador1Pronto == 0) {
				jog1Pronto.text = "Pendente";
			} else {
				jog1Pronto.text = "Pronto";
			}

			if (partida.jogador2Pronto == 0) {
				jog2Pronto.text = "Pendente";
			} else {
				jog2Pronto.text = "Pronto";
			}
		
		} else {
			nomeJog1.text = partida.jogador1;
			jog1Pronto.text = "Pendente";
			nomeJog2.text = null;
			jog2Pronto.text = "Aguardando";

		}

		scrollPartida = scrollPartidaAtual;

	}


	public void HandleClick(){
	
		if (partida.rodadaId != 0) {
			PartidaData.partidaData.getPartidaData (partida);
			SceneManager.LoadScene ("MatchScene");
		
		}
	
	}

}
