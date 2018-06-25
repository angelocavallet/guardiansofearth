using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using System.Text;

public class ConectionData : MonoBehaviour {

	public static ConectionData conectionData; 

	public string url = "http://localhost:8080/guardians/public/v1/";

	void Awake(){
		if (conectionData == null) {
			DontDestroyOnLoad (gameObject);
			conectionData = this;

		} else if (conectionData != this) {
			Destroy (gameObject);
		}
	}
		

}
