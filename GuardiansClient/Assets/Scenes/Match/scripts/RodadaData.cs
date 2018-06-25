using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using SimpleJSON;

public class RodadaData : MonoBehaviour {

	public List<JsonModel.Rodada> listaRodada;
	public JogadorData jogador;
	public OponenteData oponente;
	public SimpleObjectPool ItemObjectPool;
	public Button prontoButton;

	public bool jogadorPerdeu;
	public bool oponentePerdeu;

	public Transform itensJogador;
	public List<JsonModel.Item> listaItensJogador;

	public Transform itensOponente;
	public List<JsonModel.Item> listaItensOponente;

	public Text vidaJog1;
	public Text vidaJog2;
	public GameObject robo1;
	public GameObject robo2;


	// Use this for initialization
	void Start () {
		StartCoroutine(getRodadas());
	
	}

	public IEnumerator getRodadas(){
		jogadorPerdeu = false;
		oponentePerdeu = false;
		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"rodada?partida="+PartidaData.partidaData.id);
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);

			JSONArray rodadasJson = resp["_embedded"]["rodada"].AsArray;
			Debug.Log(rodadasJson);

			listaRodada.Clear ();
			for (int i = 0; i < rodadasJson.Count; i++) {
				JsonModel.Rodada rodada = JsonUtility.FromJson<JsonModel.Rodada>(rodadasJson [i].ToString());

				listaRodada.Add (rodada);

			}

			StartCoroutine (getItens ());

			if (listaRodada.Count > 1) {
				jogador.initData (listaRodada[listaRodada.Count -2], false);
				oponente.initData (listaRodada[listaRodada.Count -2], false);
				yield return StartCoroutine (resumeUltimaRodada (listaRodada [listaRodada.Count - 2]));

			
			}

			GameObject informativo = GameObject.Find("informativo");

			if (jogadorPerdeu && oponentePerdeu) {
				Debug.Log ("EMPATE");
				prontoButton.enabled = false;
				informativo.GetComponent<Text> ().text = "EMPATE";

			} else if (jogadorPerdeu)  {
				Debug.Log ("PERDEU");
				prontoButton.enabled = false;
				informativo.GetComponent<Text> ().text = "VOCE PERDEU";

			} else if (oponentePerdeu)  {
				Debug.Log ("GANHOU");
				prontoButton.enabled = false;
				informativo.GetComponent<Text> ().text = "VOCE VENCEU";

			} else {
				Debug.Log ("CONTINUA");

				StartCoroutine(ShowMessage(informativo.GetComponent<Text>(), "RODADA "+(listaRodada.Count).ToString(), 3.0f));
				jogador.initData (listaRodada[listaRodada.Count -1], true);
				oponente.initData (listaRodada[listaRodada.Count -1], true);
			
			}


		}
	}

	public IEnumerator resumeUltimaRodada(JsonModel.Rodada rodada){
		
		GameObject informativo = GameObject.Find("informativo");

		StartCoroutine(ShowMessage(informativo.GetComponent<Text>(), "RESUMO RODADA "+(listaRodada.Count - 1).ToString(), 3.0f));

		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"registro?rodada="+rodada.id);
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if (req.isError) {
			Debug.Log (req.error);
		} else {
			
			JSONNode resp = JSON.Parse (req.downloadHandler.text);
			Debug.Log (resp);
			JSONArray registrosJson = resp["_embedded"]["registro"].AsArray;

			yield return StartCoroutine (initResumo (registrosJson));

		}
	}

	IEnumerator initResumo(JSONArray registrosJson){


		for (int i = 0; i < registrosJson.Count; i++) {
			JsonModel.Registro registro = JsonUtility.FromJson<JsonModel.Registro>(registrosJson [i].ToString());

			yield return StartCoroutine (resumeRegistro (registro));

		}
	}

	IEnumerator resumeRegistro(JsonModel.Registro registro){

		//Vector3 posRobo1 = GameObject.Find("PosRobo1").transform.position;
		//Vector3 posRobo2 = GameObject.Find("PosRobo2").transform.position;

		Vector3 posRobo1 = robo1.transform.position;
		Vector3 posRobo2 = robo2.transform.position;

		int vidaJogador = 0;
		int ataqueJogador = 0;
		int defesaJogador = 0;
		int curaJogador = 0;

		int vidaOponente = 0;
		int ataqueOponente = 0;
		int defesaOponente = 0;
		int curaOponente = 0;

		if (UserData.userData.id == registro.jog1Id) {
			vidaJogador = registro.vidaJog1;
			ataqueJogador = registro.ataqueJog1;
			defesaJogador = registro.defesaJog1;
			curaJogador = registro.curaJog1;

			vidaOponente = registro.vidaJog2;
			ataqueOponente = registro.ataqueJog2;
			defesaOponente = registro.defesaJog2;
			curaOponente = registro.curaJog2;

		} else {
			vidaJogador = registro.vidaJog2;
			ataqueJogador = registro.ataqueJog2;
			defesaJogador = registro.defesaJog2;
			curaJogador = registro.curaJog2;

			vidaOponente = registro.vidaJog1;
			ataqueOponente = registro.ataqueJog1;
			defesaOponente = registro.defesaJog1;
			curaOponente = registro.curaJog1;
		}
		vidaJog1.text = vidaJogador.ToString();
		vidaJog2.text = vidaOponente.ToString();

		if (vidaJogador <= 0) {
			jogadorPerdeu = true;
		}
		if (vidaOponente <= 0) {
			oponentePerdeu = true;
		
		}

		if (!jogadorPerdeu && !oponentePerdeu) {
			if (curaJogador > 0) {
				if ((vidaJogador + curaJogador) > 20) {
					vidaJogador = 20;

				} else {
					vidaJogador = vidaJogador + curaJogador;
				}

				vidaJog1.text = vidaJogador.ToString();

			}


			if (curaOponente > 0) {
				if ((vidaOponente + curaOponente) > 20) {
					vidaOponente = 20;

				} else {
					vidaOponente = vidaOponente + curaOponente;
				}

				vidaJog2.text = vidaOponente.ToString();

			}

			yield return new WaitForSeconds(0.4f);

			if (ataqueJogador > 0) {
				yield return StartCoroutine(MoveObject.use.Translation(robo1.transform, posRobo1, posRobo2, 0.5f, MoveObject.MoveType.Time));
				if (ataqueJogador > defesaOponente) {
					vidaOponente = vidaOponente - (ataqueJogador - defesaOponente);
					if (vidaOponente < 0) {
						vidaOponente = 0;
						oponentePerdeu = true;
					}
					vidaJog2.text = vidaOponente.ToString();

				}
				yield return StartCoroutine(MoveObject.use.Translation(robo1.transform, posRobo2, posRobo1, 0.5f, MoveObject.MoveType.Time));
			}

			yield return new WaitForSeconds(0.4f);

			if (ataqueOponente > 0) {
				yield return StartCoroutine(MoveObject.use.Translation(robo2.transform, posRobo2, posRobo1, 0.5f, MoveObject.MoveType.Time));
				if (ataqueOponente > defesaJogador) {
					vidaJogador = vidaJogador - (ataqueOponente - defesaJogador);
					if (vidaJogador < 0) {
						vidaJogador = 0;
						jogadorPerdeu = true;
					}
					vidaJog1.text = vidaJogador.ToString();

				}
				yield return StartCoroutine(MoveObject.use.Translation(robo2.transform, posRobo1, posRobo2, 0.5f, MoveObject.MoveType.Time));
			}
		
		}


		if (vidaJogador <= 0) {
			jogadorPerdeu = true;
		}
		if (vidaOponente <= 0) {
			oponentePerdeu = true;

		}

		yield return new WaitForSeconds(1.0f);

	}


	public IEnumerator getItens(){
		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"item?partida="+PartidaData.partidaData.id);
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);
			JSONArray itensJson = resp["_embedded"]["item"].AsArray;

			listaItensJogador.Clear ();
			listaItensOponente.Clear ();

			while (itensJogador.childCount > 0) 
			{
				GameObject toRemove = itensJogador.transform.GetChild(0).gameObject;			
				ItemObjectPool.ReturnObject(toRemove);
			}

			while (itensOponente.childCount > 0) 
			{
				GameObject toRemove = itensOponente.transform.GetChild(0).gameObject;			
				ItemObjectPool.ReturnObject(toRemove);
			}

			for (int i = 0; i < itensJson.Count; i++) {
				JsonModel.Item item = JsonUtility.FromJson<JsonModel.Item>(itensJson [i].ToString());

				GameObject itemObj = ItemObjectPool.GetObject ();

				if (UserData.userData.id == item.jogador) {
					listaItensJogador.Add (item);
					itemObj.transform.SetParent (itensJogador);

				} else {
					listaItensOponente.Add (item);
					itemObj.transform.SetParent (itensOponente);

				}

				Carta carta = itemObj.GetComponent<Carta> ();
				carta.setCartaId (item.id);

			}

		}
	}

	IEnumerator ShowMessage (Text text, string message, float delay) {
		text.text = message;
		//text.enabled = true;
		yield return new WaitForSeconds(delay);
		//text.enabled = false;
		text.text = "";
	}
}
