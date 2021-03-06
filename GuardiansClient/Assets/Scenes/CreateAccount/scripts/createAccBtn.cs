                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    using UnityEngine;using System.Collections;
using UnityEngine.Networking;
using UnityEngine.UI; 
using UnityEngine.SceneManagement;
using SimpleJSON;
using System;
using System.Text;
using System.Collections.Generic;


public class createAccBtn : MonoBehaviour {

	public Text error_message;
	public InputField nome;
	public InputField email;
	public InputField senha;
	public InputField confirma;

	public void createAcc(){
		if (string.IsNullOrEmpty(nome.text)) {
			error_message.text = "Informe o nome de usário!";
		
		} else if (string.IsNullOrEmpty(email.text)) {
			error_message.text = "Informe seu email!";

		} else if (string.IsNullOrEmpty(senha.text)) {
			error_message.text = "Informe sua senha!";

		} else if (string.IsNullOrEmpty(confirma.text)) {
			error_message.text = "Confirme sua senha!";

		} else if (senha.text != confirma.text) {
			error_message.text = "Senhas não conferem!";

		} else {
			StartCoroutine(handle());	
		}

	}

	IEnumerator handle(){

		JsonModel.Usuario usua = new JsonModel.Usuario ();


		usua.nome = nome.text;
		usua.email = email.text;
		usua.senha = senha.text;

		string json = JsonUtility.ToJson(usua);
		Debug.Log (json);


		Dictionary<string,string> headers = new Dictionary<string, string>();
		headers.Add("Content-Type", "application/json");

		byte[] pData = System.Text.Encoding.ASCII.GetBytes(json.ToCharArray());

		WWW req = new WWW(ConectionData.conectionData.url+"usuario", pData, headers);

		yield return req;

		if(!string.IsNullOrEmpty(req.error)) {
			Debug.Log(req.error.ToString());
		} else {

			JSONNode resp = JSON.Parse (req.text);
			Debug.Log(resp);
			if (resp ["error"] != null) {
				UserData.userData = null;
				error_message.text = resp ["error"] [0].Value;
				Debug.Log ("oh no");	

			} else {
				SceneManager.LoadScene("LoginScene");

			}	

		}
	}

}
