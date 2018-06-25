using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using SimpleJSON;

public class NovaPartidaButton : MonoBehaviour {

	public partidaScrollList scrollList;

	public void requestNovaPartida(){
		StartCoroutine(novaPartida());	
	
	}

	IEnumerator novaPartida(){

		UnityWebRequest req = UnityWebRequest.Post(ConectionData.conectionData.url+"partida", "");
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);

			Debug.Log (resp);
			scrollList.RefreshDisplay ();
		}
	}
}
