using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using SimpleJSON;

public class OponenteData : MonoBehaviour {
	
	public int id;
	public int baraId;
	public string nome;
	public int pronto;

	public Text vida;

	public SpriteRenderer robo;

	public DragAndDropItem acao1;
	public DragAndDropItem acao2;
	public DragAndDropItem acao3;
	public DragAndDropItem acao4;
	public DragAndDropItem acao5;

	void Start () {
	}

	public void initData(JsonModel.Rodada rodada, bool loadVida){
		
		Carta carta1 = acao1.GetComponent<Carta> ();
		Carta carta2 = acao2.GetComponent<Carta> ();
		Carta carta3 = acao3.GetComponent<Carta> ();
		Carta carta4 = acao4.GetComponent<Carta> ();
		Carta carta5 = acao5.GetComponent<Carta> ();

		if (UserData.userData.id != PartidaData.partidaData.jog1Id) {

			id = PartidaData.partidaData.jog1Id;
			baraId = PartidaData.partidaData.baraJog1;
			if (loadVida) {
				vida.text = PartidaData.partidaData.vidaJogador1.ToString();
			}
			nome = PartidaData.partidaData.jogador1;
			pronto = PartidaData.partidaData.jogador1Pronto;

			carta1.setCartaId(rodada.iniciativa1Jog1);
			carta2.setCartaId(rodada.iniciativa2Jog1);
			carta3.setCartaId(rodada.iniciativa3Jog1);
			carta4.setCartaId(rodada.guardaJog1);
			carta5.setCartaId(rodada.descartaJog1);

		} else {

			id = PartidaData.partidaData.jog2Id;
			baraId = PartidaData.partidaData.baraJog2;
			if (loadVida) {
				vida.text = PartidaData.partidaData.vidaJogador2.ToString();
			}
			nome = PartidaData.partidaData.jogador2;
			pronto = PartidaData.partidaData.jogador2Pronto;

			carta1.setCartaId(rodada.iniciativa1Jog2);
			carta2.setCartaId(rodada.iniciativa2Jog2);
			carta3.setCartaId(rodada.iniciativa3Jog2);
			carta4.setCartaId(rodada.guardaJog2);
			carta5.setCartaId(rodada.descartaJog2);

		}

	}
}
