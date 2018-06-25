using System.Collections;
using System.Collections.Generic;
using System.Linq;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;
using UnityEngine.EventSystems;
using SimpleJSON;

public class Carta : MonoBehaviour, IPointerEnterHandler, IPointerExitHandler
{

	public int cartaId;
	public int pilhaCartaId;
	public GameObject cartaLookUp;


	void Start () {
		cartaLookUp = GameObject.Find("cartaLookUp");

	}

	public void OnPointerEnter(PointerEventData eventData)
	{
		setImageCarta ();
		cartaLookUp.GetComponent<Image> ().enabled = true;
	}

	public void OnPointerExit(PointerEventData eventData)
	{
		cartaLookUp.GetComponent<Image> ().enabled = false;
	}


	public void setCartaId(int id){
		pilhaCartaId = id;
		StartCoroutine (requestCartaData ());
	
	}

	IEnumerator requestCartaData(){
		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"carta/"+pilhaCartaId);
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
			yield return requestCartaData ();
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);
			Debug.Log(resp);

			cartaId = resp["id"];
			setImageAcao ();
			this.GetComponent<Image> ().enabled = true;
		}
	}

	public void setImageAcao(){

		Sprite[] sprites = Resources.LoadAll<Sprite>("Cartas/acao");

		switch(cartaId){
		case 1:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_2");
			break;
		case 2:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_1");
			break;
		case 3:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_3");
			break;
		case 4:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_4");
			break;
		case 5:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_5");
			break;
		case 6:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_9");
			break;
		case 7:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_6");
			break;
		case 8:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_10");
			break;
		case 9:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_11");
			break;
		case 10:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_13");
			break;
		case 11:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_12");
			break;
		case 12:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_7");
			break;
		case 13:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_14");
			break;
		case 14:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_16");
			break;
		case 15:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_8");
			break;
		case 16:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_17");
			break;
		case 17:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_20");
			break;
		case 18:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_18");
			break;
		case 19:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_15");
			break;
		case 20:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_19");
			break;
		case 21:
			this.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "acao_0");
			break;
		}

	}



	public void setImageCarta(){
		
		Sprite[] sprites = Resources.LoadAll<Sprite>("Cartas/carta");
		switch(cartaId){
		case 1:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_0");
			break;
		case 2:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_1");
			break;
		case 3:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_3");
			break;
		case 4:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_4");
			break;
		case 5:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_5");
			break;
		case 6:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_9");
			break;
		case 7:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_6");
			break;
		case 8:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_10");
			break;
		case 9:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_11");
			break;
		case 10:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_12");
			break;
		case 11:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_13");
			break;
		case 12:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_7");
			break;
		case 13:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_14");
			break;
		case 14:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_15");
			break;
		case 15:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_8");
			break;
		case 16:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_17");
			break;
		case 17:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_18");
			break;
		case 18:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_19");
			break;
		case 19:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_16");
			break;
		case 20:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_20");
			break;
		case 21:
			cartaLookUp.GetComponent<Image> ().sprite = sprites.Single(s => s.name == "carta_2");
			break;
		}

	}

}
