using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using SimpleJSON;

public class JogadorData : MonoBehaviour {

	public int id;
	public int baraId;
	public string nome;
	public int pronto;

	private int jogador = 0;

	public Text vida;

	public SpriteRenderer robo;

	public Button prontoBtn;

	public DragAndDropCell iniciativa1;
	public DragAndDropCell iniciativa2;
	public DragAndDropCell iniciativa3;
	public DragAndDropCell guarda;
	public DragAndDropCell descarta;

	void Start () {

	}

	public void initData(JsonModel.Rodada rodada, bool loadVida){

		Carta acao1 = iniciativa1.GetComponentInChildren<Carta> ();
		Carta acao2 = iniciativa2.GetComponentInChildren<Carta> ();
		Carta acao3 = iniciativa3.GetComponentInChildren<Carta> ();
		Carta acao4 = guarda.GetComponentInChildren<Carta> ();
		Carta acao5 = descarta.GetComponentInChildren<Carta> ();

		if (UserData.userData.id == PartidaData.partidaData.jog1Id) {
			jogador = 1;
			id = PartidaData.partidaData.jog1Id;
			baraId = PartidaData.partidaData.baraJog1;
			if (loadVida) {
				vida.text = PartidaData.partidaData.vidaJogador1.ToString();
			}
			nome = PartidaData.partidaData.jogador1;
			pronto = PartidaData.partidaData.jogador1Pronto;


			acao1.setCartaId(rodada.iniciativa1Jog1);
			acao2.setCartaId(rodada.iniciativa2Jog1);
			acao3.setCartaId(rodada.iniciativa3Jog1);
			acao4.setCartaId(rodada.guardaJog1);
			acao5.setCartaId(rodada.descartaJog1);

			if (rodada.jogador1Pronto == 1) {
				prontoBtn.interactable = false;
			} else {
				prontoBtn.interactable = true;
			
			}

		} else {
			jogador = 2;
			id = PartidaData.partidaData.jog2Id;
			baraId = PartidaData.partidaData.baraJog2;
			if (loadVida) {
				vida.text = PartidaData.partidaData.vidaJogador2.ToString();
			}
			nome = PartidaData.partidaData.jogador2;
			pronto = PartidaData.partidaData.jogador2Pronto;

			acao1.setCartaId(rodada.iniciativa1Jog2);
			acao2.setCartaId(rodada.iniciativa2Jog2);
			acao3.setCartaId(rodada.iniciativa3Jog2);
			acao4.setCartaId(rodada.guardaJog2);
			acao5.setCartaId(rodada.descartaJog2);

			if (rodada.jogador2Pronto == 1) {
				prontoBtn.interactable = false;
			} else {
				prontoBtn.interactable = true;

			}

		}



	}
}