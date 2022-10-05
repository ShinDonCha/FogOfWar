using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ScoutTank : UnitCtrl
{
    public override void SetStat(TankInfo info)
    {
        base.SetStat(info);

        nvAgent.speed = 25f;
    }

    protected override void Fire(Vector3 targetPos)
    {
        GameObject go = Instantiate(bulletPrefab);
        go.transform.position = transform.position;
        go.GetComponent<SphereCollider>().center = Vector3.zero;
        SoundManager.Instance.PlayEffSound("TankFireSound", transform.position);
        Destroy(gameObject);
    }

    private void OnDestroy()
    {
        GameObject eff = Instantiate(expEff);
        Vector3 effPos = transform.position;
        effPos.y += 3f;
        eff.transform.position = effPos;

        Destroy(eff, 0.4f);
    }
}