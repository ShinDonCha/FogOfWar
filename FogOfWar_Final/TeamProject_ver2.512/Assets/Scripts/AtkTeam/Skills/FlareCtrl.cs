using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FlareCtrl : MonoBehaviour
{
    int lv = 0;
    // Start is called before the first frame update
    void Start()
    {
        lv = GlobalValue.SkillLvDic[SkillType.Flare];
        transform.localScale *= 1 + ((float)lv * .1f);
        GetComponent<FowUnit>().sightRange *= 1 + ((float)lv * .1f);
        Destroy(gameObject, 3f);
    }
}
