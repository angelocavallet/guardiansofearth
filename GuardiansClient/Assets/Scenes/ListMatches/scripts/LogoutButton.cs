using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class LogoutButton : MonoBehaviour {


	public void logout(){
		UserData.userData.logout();
		SceneManager.LoadScene("LoginScene");

	}
}
