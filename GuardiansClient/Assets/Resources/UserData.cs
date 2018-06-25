using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using System.Text;

public class UserData : MonoBehaviour {

	public static UserData userData; 

	public int id;
	public string nome;
	public string email;
	public string senha;

	void Awake(){
		if (userData == null) {
			DontDestroyOnLoad (gameObject);
			userData = this;
		
		} else if (userData != this) {
			Destroy (gameObject);
		}
	}

	public string getHttpHeaderAuthentication(){

		byte[] bytesToEncode = Encoding.UTF8.GetBytes(email+":"+senha);
		return "Basic "+Convert.ToBase64String(bytesToEncode);

	}

	public void logout(){
		userData.id = 0;
		userData.nome = null;
		userData.email = null;
		userData.senha = null;
	}

}
