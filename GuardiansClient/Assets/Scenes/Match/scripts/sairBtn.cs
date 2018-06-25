using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class sairBtn : MonoBehaviour {


	public void sair(){

		PartidaData.partidaData.sairPartida ();
		SceneManager.LoadScene("ListMatchesScene");

	}
}
