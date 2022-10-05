Shader "Simple/Bullet"
{
	Properties
	{
		_MainTex("Base (RGB)", 2D) = "white" {}
	}

	SubShader
	{
		Tags { "Queue" = "Transparent" "IgnoreProjector" = "True" "RenderType" = "Transparent" }
		ZTest Off

		BindChannels 
		{
			Bind "Color", color
			Bind "Vertex", vertex
			Bind "texcoord", texcoord
		}

	    Pass
		{
			ColorMaterial AmbientAndDiffuse
			SetTexture[_MainTex] {Combine texture * primary}
		}
	}
}