using System.Collections;
using System.Collections.Generic;
using UnityEngine;


public class ShieldSkill : MonoBehaviour
{
    private List<ShieldCtrl> STanks = new List<ShieldCtrl>();
    float ShieldTimer = 3.0f;           //실드 지속시간
    int lv = 0;
    public Transform effTr;

    private void Start()
    {
        lv = GlobalValue.SkillLvDic[SkillType.Shield];
        GetComponent<SphereCollider>().radius *= 1 + ((float)lv * .1f);
        effTr.localScale *= 1 + ((float)lv * .1f);
        Destroy(gameObject, ShieldTimer);
    }

    private void OnTriggerEnter(Collider other)          //실드 범위 안에 있을때만 방어가능
    {
        if (other.CompareTag("Unit"))
        {
            if (!STanks.Contains(other.GetComponent<ShieldCtrl>()))
                STanks.Add(other.GetComponent<ShieldCtrl>());
            other.gameObject.GetComponent<ShieldCtrl>().isShieldOn = true;
        }
    }
    private void OnTriggerExit(Collider other)          //실드범위 밖으로 나가면 방어 안됨
    {
        if (other.CompareTag("Unit"))
        {
            STanks.Remove(other.gameObject.GetComponent<ShieldCtrl>());
            other.gameObject.GetComponent<ShieldCtrl>().isShieldOn = false;            
        }
    }

    private void OnDestroy()
    {
        //실드 파괴될 때 안에있는 탱크들 실드 다 꺼주기
        if (STanks != null)             //리스트가 비어있지 않다면                       
            for (int i = 0; i < STanks.Count; i++)
                STanks[i].isShieldOn = false;
    }
}
