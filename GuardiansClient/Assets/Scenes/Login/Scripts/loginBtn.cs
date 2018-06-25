using UnityEngine;
using System.Collections;
using UnityEngine.Networking;
using UnityEngine.UI; 
using UnityEngine.SceneManagement;
using System;
using System.Text;
using SimpleJSON;

public class loginBtn : MonoBehaviour {

	public Text error_message;

	public InputField email;
	public InputField senha;

	public void requestLogin(){
		StartCoroutine(handle());	
	}

	IEnumerator handle(){
		UserData.userData.email = email.text;
		UserData.userData.senha = senha.text;

		UnityWebRequest req = UnityWebRequest.Get(ConectionData.conectionData.url+"usuario");
		req.SetRequestHeader("Authorization", UserData.userData.getHttpHeaderAuthentication());
		yield return req.Send();

		if(req.isError) {
			Debug.Log(req.error);
		} else {

			JSONNode resp = JSON.Parse (req.downloadHandler.text);
			Debug.Log(resp);
			if (resp ["error"] != null) {
				UserData.userData.logout();
				error_message.text = resp ["error"] [0].Value;
				Debug.Log ("oh no");	
			
			} else {
				UserData.userData.id = resp ["id"];
				UserData.userData.nome = resp ["nome"];

				SceneManager.LoadScene("ListMatchesScene");
			}	

		}
	}

}
