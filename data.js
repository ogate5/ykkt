// �޸����ص��ļ�����˵����ÿ���ļ�һ�С�file ΪԴ�ļ�����zw Ϊ�����ļ�������ʡ�ԣ���title Ϊ�ļ�˵��������ļ������� media Ŀ¼
var g_aList1 = [
	{file:"zhenxiang.zip",zw:"����.zip",title:"������أ�������ǽ����������顢ͼƬ�ȡ�zip ��ʽ"},
	{file:"rar-android.apk",zw:"RAR ��׿��.apk",title:"��ѹ�����RAR ��׿�棬�ɽ�ѹ zip �ļ�"},
	{file:"zym-win.zip",zw:"������ - ���԰�.zip",title:"��ǽ����������� - ���԰�"},
	{file:"wjll-win.zip",zw:"�޽���� - ���԰�.zip",title:"��ǽ������޽���� - ���԰�"},
//	{file:"fg.apk",zw:"������ - ��׿��.apk",title:"��ǽ����������� - ��׿��"},
	{file:"um.apk",zw:"�޽�һ��ͨ - ��׿��.apk",title:"��ǽ������޽�һ��ͨ - ��׿��"},
//	{file:"iNTD_TV.apk",zw:"�����˵��� - ��׿��.apk",title:"��ǽ����������˵��� - ��׿��"},
	{file:"vlc.apk",zw:"VLC ý�岥���� - ��׿��.apk",title:"ý�岥������VLC ��׿�棬֧�ָ��ָ�ʽ����Ƶ����Ƶ�ļ�"},
	{file:"lithium.apk",zw:"� EPUB �Ķ��� - ��׿��.apk",title:"�Ķ������� EPUB �Ķ�����׿�棬�ɿ� ePub ��ʽ������"},
	{file:"9ping.epub",zw:"����������.epub",title:"�����飺��������������ePub ��ʽ"},
	{file:"zjmd.epub",zw:"����������ռ�Ŀ��.epub",title:"�����飺������������ռ�Ŀ�ġ�ePub ��ʽ"},
	{file:"jtdwh.epub",zw:"���嵳�Ļ�.epub",title:"�����飺�����嵳�Ļ���ePub ��ʽ"},
	{file:"fytdx.epub",zw:"���������.epub",title:"�����飺����������С�ePub ��ʽ"},
	{file:"jzmqr.epub",zw:"����������.epub",title:"�����飺�����������ˡ�ePub ��ʽ"},
	{file:"mksdcmzl.epub",zw:"���˼�ĳ�ħ֮·.epub",title:"�����飺�����˼�ĳ�ħ֮·��ePub ��ʽ"},	
	{file:"jkemdms.epub",zw:"�ҿ���ħ����ɴ.epub",title:"�����飺���ҿ���ħ����ɴ��ePub ��ʽ"},
	{file:"mro.epub",zw:"���̷��ڲ�ס�����г���Ģ����.epub",title:"�����飺�����̷��ڲ�ס�����г���Ģ���ơ�ePub ��ʽ"},
	{file:"gczydzjmd.zip",zw:"����������ռ�Ŀ��.zip",title:"�����飺������������ռ�Ŀ�ġ�zip ��ʽ"},
];

// �޸�ͼƬ���ļ�����˵����ÿ�пɶ���ļ�����Ӣ�Ķ��ŷָ���
var g_aList2 = [
	{file:"jbzxxl1.jpg,jbzxxl2.jpg,jbzxxl3.jpg,jbzxxl4.jpg,jbzxxl5.jpg",title:"��������"},
	{file:"fldfhcsj1.jpg,fldfhcsj2.jpg,fldfhcsj3.jpg,fldfhcsj4.jpg,fldfhcsj5.jpg,fldfhcsj6.jpg",title:"���ִ󷨺봫����"},
	{file:"czsjm1.jpg,czsjm2.jpg,czsjm3.jpg",title:"����ʯ����"},
	{file:"zcswwq1.jpg,zcswwq2.jpg",title:"�߳�˼ά����"},
	{file:"ysnbjhp1.jpg,ysnbjhp2.jpg,ysnbjhp3.jpg,ysnbjhp4.jpg,ysnbjhp5.jpg,ysnbjhp6.jpg,ysnbjhp7.jpg,ysnbjhp8.jpg,ysnbjhp9.jpg",title:"һ���ܱ�����ƭ"},
	{file:"wsmqntd1.jpg,wsmqntd2.jpg",title:"ΪʲôȰ���˵�"},
	{file:"nbdsfgls1.jpg,nbdsfgls2.jpg",title:"���Ѷ��ķ�����˭"},
	{file:"bjmh15.jpg",title:"��������"},
];

// �޸���Ƶ���ļ����������ļ�������ʡ�ԣ���˵����ÿ���ļ�һ�С�Ҫ��ʹ��һ�У��������׼� //
var g_aList3 = [
	{file:"zgbszg.mp4",zw:"�й������й��˳��й�����δ��.mp4",title:"�й������й� �˳��й�����δ��"},
	{file:"zf-dsp.mp4",zw:"���Էٻ���ƭ��.mp4",title:"���Էٻ���ƭ�֣�"},
	{file:"425.mp4",zw:"�Ķ����Ϸ�����.mp4",title:"���ġ����塱�Ϸ�����"},
	{file:"jx1400li-dsp.mp4",zw:"����1400��.mp4",title:"������1400����"},
	{file:"tmzg.mp4",zw:"�����й�.mp4",title:"�����й���2�ڣ�"},
	{file:"weihuo.mp4",zw:"α�� - �찲���Է��¼�����.mp4",title:"α��:���찲���Է١�����"},
	{file:"hcym.mp4",zw:"�쳯��ı - ��������ϴ�δ�й���а��.mp4",title:"�쳯��ı - ��������ϴ�δ�й���а��"},	
	{file:"hzxc.mp3",zw:"��ժ�ֳ���ǹ����֤��.mp3",title:"��ժ�ֳ���ǹ����֤�ʣ���Ƶ��"},
	{file:"bxls.mp3",zw:"������˵������ϯ�µ�����.mp3",title:"������˵������ϯ�µ������Ƶ��"},
	{file:"lccs.mp3",zw:"���˵������������������.mp3",title:"���˵�����������������£���Ƶ��"},
	{file:"jzzjfy.mp3",zw:"�����м���Ժ��һ������˵.mp3",title:"�����м���Ժ��һ������˵����Ƶ��"},
];
