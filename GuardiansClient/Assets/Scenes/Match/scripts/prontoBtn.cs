using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using SimpleJSON;

public class prontoBtn : MonoBehaviour {

	public Button prontoButton;
	public DragAndDropCell iniciativa1;
	public DragAndDropCell iniciativa2;
	public DragAndDropCell iniciativa3;
	public DragAndDropCell guarda;
	public DragAndDropCell descarta;

	public void pronto(){

		prontoButton.interactable = false;
		StartCoroutine (enviaJogada ());

	}

	public IEnumerator enviaJogada(){

		JsonModel.Jogada jogada = new JsonModel.Jogada();

		jogada.partida = PartidaData.partidaData.id;

		jogada.iniciativa1 = iniciativa1.GetComponentInChildren<Carta> ().pilhaCartaId;
		jogada.iniciativa2 = iniciativa2.GetComponentInChildren<Carta> ().pilhaCartaId;
		jogada.iniciativa3 = iniciativa3.GetComponentInChildren<Carta> ().pilhaCartaId;
		jogada.guarda = guarda.GetComponentInChildren<Carta> ().pilhaCartaId;
		jogada.descarta = descarta.GetComponentInChildren<Carta> ().pilhaCartaId;

		string json = JsonUtility.ToJson(jogada);

		byte[] data = System.Text.Encoding.UTF8.GetBytes(json);

		UnityWebRequest req = UnityWebRequest.Put(ConectionData.conectionData.url+"rodada/"+PartidaData.partidaData.rodadaId, data);
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		req.SetRequestHeader("Content-Type", "application/json");
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
			prontoButton.interactable = true;
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);

			Debug.Log (resp);

			StartCoroutine (verificaPartida ());

		}
	}


	IEnumerator verificaPartida(){
		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"partida/"+PartidaData.partidaData.id);
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);
			Debug.Log (resp);
			JsonModel.Partida partida = JsonUtility.FromJson<JsonModel.Partida>(resp.ToString());

			if (partida.rodadaId != PartidaData.partidaData.rodadaId) {

				PartidaData.partidaData.getPartidaData (partida);

				GameObject rodadaData = GameObject.Find ("RodadaData");

				StartCoroutine (rodadaData.GetComponent<RodadaData> ().getRodadas ());
			
			} else {	
				yield return new WaitForSeconds(2.0f);
				StartCoroutine(verificaPartida());
			}
		}
	}
}
