using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlaneCtrl : MonoBehaviour
{    
    Vector3 moveDir = Vector3.zero;                  //비행기와 가상표식 사이의 벡터를 담을 변수
    float moveSpeed = 0.0f;                          //비행기 이동속도    

    //------- 폭격 관련
    Vector3 calcPos = Vector3.zero;
    Vector3 boomPos;             //폭격 이미지 생성할 위치변수        
    float boomTime = 0.02f;                         //폭격 간격

    //------- 폭격 관련        
    LandSignCtrl lsc;
    public GameObject BoomPrefab;

    int lv = 0;
    
    // Start is called before the first frame update
    void Start()
    {
        lv = GlobalValue.SkillLvDic[SkillType.Plane];

        lsc = FindObjectOfType<LandSignCtrl>();
        moveDir = lsc.TargetPos - transform.position;
        moveDir.y = 0.0f;
        moveSpeed = moveDir.magnitude / 1.5f;       //총쏘는 시간 2초에 맞춰 비행기 속도 조절(표식위치에 닿기 전 속도)
        boomPos = lsc.TargetPos;
        Destroy(gameObject, 4.0f);                  //4초뒤 비행기 오브젝트 삭제
    }

    // Update is called once per frame
    void Update()
    {
        calcPos = lsc.TargetPos - transform.position;
        calcPos.y = 0.0f;
        if (calcPos.magnitude <= 3f)
        {
            boomTime -= Time.deltaTime;                     //폭격 발생 간격
            if (boomTime <= 0.0f)         //폭격 최대 9번
            {
                Debug.Log("Bomb!");
                GameObject boomObj = Instantiate(BoomPrefab, boomPos, Quaternion.identity);
                boomObj.GetComponent<BoomCtrl>().damage = 20 + lv * 5;
                Destroy(boomObj, 3f);
                boomTime = 4f;
            }
        }

        transform.Translate(moveDir.normalized * Time.deltaTime * moveSpeed, Space.World);            //이동속도에 따라 비행기 이동
    }
}
