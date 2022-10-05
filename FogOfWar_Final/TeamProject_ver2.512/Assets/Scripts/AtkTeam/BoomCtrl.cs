using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BoomCtrl : MonoBehaviour
{
    public int damage = 20;
    private void OnTriggerEnter(Collider other)
    {
        if (other.CompareTag("Tower"))
            other.gameObject.GetComponent<TowerDamage>().TakeDamage(damage);

        SoundManager.Instance.PlayEffSound("BombSound", transform.position);

        Destroy(gameObject, 1f);
    }
}
