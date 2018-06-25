using UnityEngine;
using System.Collections;

public class MoveObject : MonoBehaviour
{

	public enum MoveType { Time, Speed }
	public static MoveObject use = null;

	void Awake()
	{
		if (use)
		{
			Debug.LogWarning("Only one instance of the MoveObject script in a scene is allowed");
			return;
		}
		use = this;
	}

	public IEnumerator TranslateTo(Transform thisTransform, Vector3 endPos, float value, MoveType moveType)
	{
		yield return Translation(thisTransform, thisTransform.position, endPos, value, moveType);
	}

	public IEnumerator Translation(Transform thisTransform, Vector3 endPos, float value, MoveType moveType)
	{
		yield return Translation(thisTransform, thisTransform.position, thisTransform.position + endPos, value, moveType);
	}

	public IEnumerator Translation(Transform thisTransform, Vector3 startPos, Vector3 endPos, float value, MoveType moveType)
	{
		float rate = (moveType == MoveType.Time) ? 1.0f / value : 1.0f / Vector3.Distance(startPos, endPos) * value;
		float t = 0.0f;
		while (t < 1.0)
		{
			t += Time.deltaTime * rate;
			thisTransform.position = Vector3.Lerp(startPos, endPos, Mathf.SmoothStep(0.0f, 1.0f, t));
			yield return null;
		}
	}

	public IEnumerator Rotation(Transform thisTransform, Vector3 degrees, float time)
	{
		Quaternion startRotation = thisTransform.rotation;
		Quaternion endRotation = thisTransform.rotation * Quaternion.Euler(degrees);
		float rate = 1.0f / time;
		float t = 0.0f;
		while (t < 1.0f)
		{
			t += Time.deltaTime * rate;
			thisTransform.rotation = Quaternion.Slerp(startRotation, endRotation, t);
			yield return null;
		}
	}
}