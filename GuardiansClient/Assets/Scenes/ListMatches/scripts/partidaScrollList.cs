using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using SimpleJSON;

public class partidaScrollList : MonoBehaviour {

	public List<JsonModel.Partida> listaPartida;
	public Transform contentPanel;
	public SimpleObjectPool buttonObjectPool;


	// Use this for initialization
	void Start () {
		RefreshDisplay ();
		InvokeRepeating("RefreshDisplay", 2.0f, 2.0f);
	}

	public void RefreshDisplay(){
		StartCoroutine(getPartidas());

	}


	IEnumerator getPartidas(){
		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"partida");
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);

			Debug.Log(resp);
			JSONArray partidasJson = resp["_embedded"]["partida"].AsArray;

			listaPartida.Clear ();
			for (int i = 0; i < partidasJson.Count; i++) {
				JsonModel.Partida partida = JsonUtility.FromJson<JsonModel.Partida>(partidasJson [i].ToString());

				listaPartida.Add (partida);
			
			}
			RemoveButtons();
			AddButtons();
		}
	}

	private void RemoveButtons(){

		while (contentPanel.childCount > 1) 
		{
			GameObject toRemove = transform.GetChild(1).gameObject;			
			buttonObjectPool.ReturnObject(toRemove);
		}
	}

	private void AddButtons(){
		for (int i = 0; i < listaPartida.Count; i++) {

			JsonModel.Partida partida = listaPartida [i];
			GameObject newButton = buttonObjectPool.GetObject ();

			newButton.transform.SetParent (contentPanel);
			newButton.transform.localScale = new Vector3 (1, 1, 1);

			listaPartidaBtn buttonPartida = newButton.GetComponent<listaPartidaBtn>();

			buttonPartida.Setup (partida, this);

		}

	}
}
