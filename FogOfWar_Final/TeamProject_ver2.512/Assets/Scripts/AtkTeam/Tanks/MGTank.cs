using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class MGTank : UnitCtrl
{
    public Transform L_pos;
    public Transform R_pos;

    //MG 연사력을 빠르게하고 데미지를 적게 할 예정이므로 DB수정 요함 *

    protected override void Fire(Vector3 targetPos)
    {
        if (target == null)
            return;

        GameObject L_MG = Instantiate(bulletPrefab);
        L_MG.transform.position = L_pos.position;

        GameObject R_MG = Instantiate(bulletPrefab);
        R_MG.transform.position = R_pos.position;

        targetDir = (targetPos - transform.position).normalized;
        BulletCtrl L_MGbullet = L_MG.GetComponent<BulletCtrl>();
        L_MGbullet.damage = stat.damage;  //MG 데미지와 어택쿨타임 수정
        BulletCtrl R_MGbullet = R_MG.GetComponent<BulletCtrl>();
        R_MGbullet.damage = stat.damage;

        targetDir.y -= 10;
        L_MGbullet.BulletSpawn(L_pos, targetDir, target);
        R_MGbullet.BulletSpawn(R_pos, targetDir, target);
    }
}
