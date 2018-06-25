using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class createAccGoBtn : MonoBehaviour {

	public void goCreateAcc(){
		SceneManager.LoadScene ("CreateAccountScene");
	}
}
