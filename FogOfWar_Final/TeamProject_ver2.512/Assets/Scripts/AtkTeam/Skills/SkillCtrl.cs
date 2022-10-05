using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class SkillCtrl : MonoBehaviour
{
    public GameObject[] targetMark;
    public SkillType type;
    public RawImage iconImg;
    public float cool;

    public Image skillCoolImg;

    MouseSignCtrl pervMouseSign;

    // Start is called before the first frame update
    void Start()
    {
        iconImg = GetComponentInChildren<RawImage>();
        GetComponent<Button>().onClick.AddListener(TargetMarkOn);
    }

    void Update()
    {
        if(cool > 0f)
        {
            cool -= Time.deltaTime;
            if (cool <= 0f)
                cool = 0f;
        }

        skillCoolImg.fillAmount = cool / 3f;
    }

    void TargetMarkOn()
    {
        if (cool > 0f)
            return;

        pervMouseSign = FindObjectOfType<MouseSignCtrl>();
        if (pervMouseSign != null)
        {
            Destroy(pervMouseSign.gameObject);
        }
        GameObject go = Instantiate(targetMark[(int)type]);
        go.transform.localScale = new Vector3(5, 5, 1);
        go.GetComponent<MouseSignCtrl>().type = type;
    }
}
