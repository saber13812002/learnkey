
//using MvcApp_csom_irib_01.Models;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.IO;
using System.Net;
using System.Net.Http;
using System.Web.Http;



namespace MvcApp_irib_spClass.Controllers
{
   
    // GET learnkey/getroot/0/
    public class getrootController : ApiController
    {
        SqlCommand com = new SqlCommand();
        //SqlConnection con = new SqlConnection("Data Source=.;Initial Catalog=learnkey_arjang;Integrated Security=True");
        //SqlConnection con = new SqlConnection("Data Source=185.55.225.11;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=fDsd047$");
        WebApiApplication wa = new WebApiApplication();

        public List<learnkeyReport> andReps = new List<learnkeyReport>();


        // GET learnkey/getroot/0/
        public IEnumerable<string> Get()
        {
            return new string[] { "value1", "value2" };
        }

        // GET learnkey/getroot/0/
        public List<learnkeyReport> Get(int id1)
        {
            learnkeyReport lrep = new learnkeyReport();

            string connStr = ConfigurationManager.ConnectionStrings["LearnKeyConnection"].ToString();
            // در زمانی که در سرور شرکت اجرا می کنم
            SqlConnection con = new SqlConnection(connStr);


            if (id1 == 0)
            {
                string storeprocedurename = "mysp_learnkey_mainandroid";
                DataTable dt = wa.runstoreprocedure(storeprocedurename, "");

                for (int i = 0; i < dt.Rows.Count; i++)
                {
                    lrep = new learnkeyReport();
                    lrep.id = int.Parse(dt.Rows[i][0].ToString()).ToString();
                    lrep.rootid = int.Parse(dt.Rows[i][1].ToString()).ToString();
                    lrep.tartib = i;
                    lrep.title = dt.Rows[i][2].ToString();           
                    lrep.type = dt.Rows[i][3].ToString();
                    lrep.type1 = dt.Rows[i][4].ToString(); 
                    andReps.Add(lrep);
                }
            }
            else if (id1 > 0 && id1 < 10)
            {
              
                string storeprocedurename = "mysp_learnkey_mainandroid";
                DataTable dt = wa.runstoreprocedure(storeprocedurename, "");
                String[] sp = new String[dt.Rows.Count];           
                for (int j =0; j < dt.Rows.Count; j++)
                {
                    sp[j] = dt.Rows[j][5].ToString();
                }
                   
                    storeprocedurename = sp[id1-1];
                    DataTable dt1 = wa.runstoreprocedure(storeprocedurename, "");
                    int count_column = dt1.Columns.Count;
                    for (int i = 0; i < dt1.Rows.Count; i++)
                    {
                     
                        lrep = new learnkeyReport();
                        lrep.id = (int.Parse(dt1.Rows[i][0].ToString()) + (1000 * id1)).ToString();
                        lrep.rootid = id1.ToString();
                        lrep.tartib = i;
                        lrep.title = dt1.Rows[i][1].ToString();
                        for (int k = 0; k < count_column; k++)
                        {
                            lrep.matn += "column[" + k + "]=" + dt1.Rows[i][k].ToString() + " ; ";
                        }
                        //lrep.title = dt.Rows[i][2].ToString();
                        //lrep.matn = dt.Rows[i][3].ToString();
                        lrep.type = "r2";
                        lrep.type1 = "str";
                        andReps.Add(lrep);
                    }
            }
                else
                {             
                    int a = id1 / 1000;
                    int id = id1 - (a * 1000);
                    string storeprocedurename = "mysp_learnkey_mainandroid";
                    DataTable dt = wa.runstoreprocedure(storeprocedurename, "");
                    String[] sp = new String[dt.Rows.Count];                 
                    string table= dt.Rows[a-1][6].ToString().Trim();
                    string idname = "id";

                    if (table == "lk_arj_nextcourses$")
                        idname = "id_cource";
                    //lk_arj_instructor$    // id_ins
                    else if (table == "lk_arj_instructor$")
                        idname = "id_ins";
                    //id_news
                    else if (table == "lk_arj_news$")
                        idname = "id_news";
                        //
                    else if (table == "lk_arj_maghalat$")
                        idname = "id_magahle";
                        //
                    else if (table == "lk_arj_certified$")
                        idname = "id_ins";


                    com.CommandText = "SELECT * FROM " + table + " where " + idname + "=N'" + id + "'";

                    com.Connection = con;
                    SqlDataReader dr = null;
                    con.Open();
                    dr = com.ExecuteReader();
                    dr.Read();
                    int d= dr.FieldCount;

                    lrep.id = int.Parse(dr[idname].ToString()) + 10000 + (1000 * a).ToString();
                    lrep.rootid = id1.ToString();
                    lrep.tartib = 0;
                    lrep.title = dr[1].ToString();             
                    for (int k = 0; k < d; k++)
                    {
                        lrep.matn += "column[" + k + "]=" + dr[k].ToString() + " ; ";
                    }
                    lrep.type = "d";
                    lrep.type1 = "str";
                    con.Close();
                    dr.Close();
                    andReps.Add(lrep);
                }           

            return andReps;
        }
    }


    public class get_tabsController : ApiController
    {
        SqlCommand com = new SqlCommand();
        //SqlConnection con = new SqlConnection("Data Source=.;Initial Catalog=learnkey_arjang;Integrated Security=True");
        //SqlConnection con = new SqlConnection("Data Source=.\\crm;Initial Catalog=Melks;Integrated Security=True");
        //SqlConnection con = new SqlConnection("Data Source=185.55.225.11;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=fDsd047$");
        WebApiApplication wa = new WebApiApplication();

        public List<learnkeyReport> andReps = new List<learnkeyReport>();
        //public List<learnkeyReport2> andReps2 = new List<learnkeyReport2>();


        // GET learnkey/getroot/0/
        public IEnumerable<string> Get()
        {
            return new string[] { "value1", "value2" };
        }

        // GET learnkey/getroot/0/
        public List<learnkeyReport> Get(int id1,int page)
        {
            learnkeyReport lrep = new learnkeyReport();


            if (id1 == 0)
            {
                string storeprocedurename = "getMelksByCode";
                DataTable dt = wa.runstoreprocedure(storeprocedurename, "");

                //for (int i = 0; i < dt.Rows.Count; i++)
                {
                    lrep = new learnkeyReport();
                    lrep.id = "1";
                    lrep.rootid = 0.ToString();
                    lrep.tartib = 1;
                    lrep.title = "تهران";
                    lrep.type = "";
                    lrep.type1 = "";
                    andReps.Add(lrep);
                }
                {
                    lrep = new learnkeyReport();
                    lrep.id = "2";
                    lrep.rootid = 0.ToString();
                    lrep.tartib = 2;
                    lrep.title = "قم";
                    lrep.type = "";
                    lrep.type1 = "";
                    andReps.Add(lrep);
                }
                {
                    lrep = new learnkeyReport();
                    lrep.id = "3";
                    lrep.rootid = 0.ToString();
                    lrep.tartib = 3;
                    lrep.title = "اصفهان";
                    lrep.type = "";
                    lrep.type1 = "";
                    andReps.Add(lrep);
                }
                {
                    lrep = new learnkeyReport();
                    lrep.id = "4";
                    lrep.rootid = 0.ToString();
                    lrep.tartib = 4;
                    lrep.title = "مشهد";
                    lrep.type = "";
                    lrep.type1 = "";
                    andReps.Add(lrep);
                }
            }
            
            else
            {

                lrep.id = 2143.ToString();
                lrep.rootid = id1.ToString();
                lrep.tartib = 0;
                lrep.title = "werqwer";

                lrep.type = "d";
                lrep.type1 = "str";
                andReps.Add(lrep);
            }

            return andReps;
        }
    }

        public class getController : ApiController
    {
        SqlCommand com = new SqlCommand();
        //SqlConnection con = new SqlConnection("Data Source=.;Initial Catalog=learnkey_arjang;Integrated Security=True");
        //SqlConnection con = new SqlConnection("Data Source=.\\crm;Initial Catalog=Melks;Integrated Security=True");
        //SqlConnection con = new SqlConnection("Data Source=185.55.225.11;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=fDsd047$");
        WebApiApplication wa = new WebApiApplication();

        //public List<learnkeyReport> andReps = new List<learnkeyReport>();
        public List<learnkeyReport2> andReps2 = new List<learnkeyReport2>();


        // GET learnkey/getroot/0/
        public IEnumerable<string> Get()
        {
            return new string[] { "value1", "value2" };
        }

        // GET learnkey/getroot/0/
        public List<learnkeyReport2> Get(int id1,int page)
        {
            learnkeyReport2 lrep2 = new learnkeyReport2();


         if (id1 > 0 && id1 < 10)
            {

                string storeprocedurename = "getallMelks";
                DataTable dt = wa.runstoreprocedure(storeprocedurename, "");

                //int count_column = dt.Columns.Count;
                //int dah = dt.Rows.Count;
                //if (dt.Rows.Count > 10)
                //    dah = (dt.Rows.Count / 10) * (page) + dt.Rows.Count;
                //for (int i = (page-1)*10; i < dah; i++)
                for (int i = dt.Rows.Count-1 ; i > -1; i--)
                {
                    
                    lrep2 = new learnkeyReport2();
                    lrep2.id = dt.Rows[i][2].ToString();
                    //lrep2.id = id1.ToString();
                    //lrep2. = i;
                    if(id1==1)
                        lrep2.title = "تهران-"+dt.Rows[i][1].ToString();
                    else if(id1==2)
                        lrep2.title = "قم-"+dt.Rows[i][1].ToString();
                    else if(id1==3)
                        lrep2.title = "اصفهان-"+dt.Rows[i][1].ToString();
                    else if(id1==4)
                        lrep2.title = "مشهد-"+dt.Rows[i][1].ToString();

                    lrep2.desc = "عنوان ملک :   " + dt.Rows[i][2].ToString() + "  \n\r"
                               + "نوع ملک   :   " + dt.Rows[i][3].ToString() + " \n\r"
                               + "تاریخ ثبت :   " + dt.Rows[i][4].ToString() + " \n\r"
                               + "تعداد بازدید :" + dt.Rows[i][6].ToString() + " \n\r"
                               + "عرض چغرافیایی : " + dt.Rows[i][7].ToString() + " \n\r"
                               + "طول جغرافیایی :" + dt.Rows[i][8].ToString() + " \n\r";
                    lrep2.pic = dt.Rows[i][9].ToString();
                    lrep2.off = dt.Rows[i][10].ToString();
                    lrep2.price = dt.Rows[i][11].ToString();
                    lrep2.gurl = @"https://www.google.com/search?q=site:learnkey.ir+ملک+" + dt.Rows[i][2].ToString();
                    andReps2.Add(lrep2);
                }
            }
            
            else
            {

                lrep2.title = "id out of range";

                andReps2.Add(lrep2);
            }

            return andReps2;
        }
    }

    //"Data Source=learnkey.ir;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=bGd$4p20"

    public class setController : ApiController
    {
        SqlCommand com = new SqlCommand();
        //SqlConnection con = new SqlConnection("Data Source=.;Initial Catalog=learnkey_arjang;Integrated Security=True");
        //SqlConnection con = new SqlConnection("Data Source=.\\crm;Initial Catalog=Melks;Integrated Security=True");
        //"Data Source=learnkey.ir;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=bGd$4p20"
        //"Data Source=185.55.225.11;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=fDsd047$"
        //SqlConnection con = new SqlConnection("Data Source=learnkey.ir;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=bGd$4p20");
        

        WebApiApplication wa = new WebApiApplication();

        public List<learnkeyReport> andReps = new List<learnkeyReport>();


        // GET learnkey/getroot/0/
        public IEnumerable<string> Get()
        {
            return new string[] { "value1", "http://mvc.learnkey.ir/learnkey/get/Code/Title/Type/Date/VisitCount/GpsLat/GpsLit/Pics/tok" };
        }

        // GET learnkey/getroot/0/
        public List<learnkeyReport> Get(string Code, string Title, string Type, string Date, string VisitCount, string GpsLat, string GpsLit,string Pics, string tok)
        {
            learnkeyReport lrep = new learnkeyReport();

            string connStr = ConfigurationManager.ConnectionStrings["LearnKeyConnection"].ToString();
            // در زمانی که در سرور شرکت اجرا می کنم
            SqlConnection con = new SqlConnection(connStr);

            if (tok == "adfadfadf")
            {
                try
                {
                    
                        MelksType kolb = new MelksType();
                        kolb.Title = Title;
                        kolb.Code = Code;
                        kolb.Type = Type;
                        Date = Date.Replace('-', '/');
                        kolb.Date = Date;
                        kolb.VisitCount = VisitCount;
                        kolb.GpsLat = GpsLat;
                        kolb.GpsLit = GpsLit;
                        kolb.Pics = Pics;

                    if (wa.getStatusItemById("getMelksByCode", Code))
                    {
                        string storeprocedurename = "SetInsertMelks";
                        int a = wa.InsertorUPdateMelks(storeprocedurename, kolb, con, false);

                        lrep = new learnkeyReport();
                        lrep.id = a.ToString();
                        lrep.rootid = a.ToString();
                        lrep.tartib = a;
                        lrep.title = "success";
                        lrep.type = "a";
                        lrep.type1 = "a";
                        andReps.Add(lrep);
                    }
                    else
                    {
                        string storeprocedurename = "SetUpdateMelks";
                        int a = wa.InsertorUPdateMelks(storeprocedurename, kolb, con,true);

                        lrep = new learnkeyReport();
                        lrep.id = a.ToString();
                        lrep.rootid = a.ToString();
                        lrep.tartib = a;
                        lrep.title = "update";
                        lrep.type = "a";
                        lrep.type1 = "a";
                        andReps.Add(lrep); 
                    }
                }
                catch (Exception ex)
                {
                    lrep = NewMethod_error(lrep, ex.Message.Substring(0,200));
                    //todo log to log db
                }
            }
            else 
            {
                // get last log token  intrupt
                lrep = NewMethod_error(lrep,"token");

                //todo log to log db token save konim
            }
            

            return andReps;
        }

        [HttpPost]
        [ActionName("PostLearnkeyReport2")]
        public HttpResponseMessage PostLearnkeyReport2([FromBody] learnkeyReport2 item)
        {

            //your code here

            var response = new HttpResponseMessage(HttpStatusCode.Created)
            {
                Content = new StringContent("YourResult")
            };

            return response;
        }


        private learnkeyReport NewMethod_error(learnkeyReport lrep,string msg)
        {
            lrep = new learnkeyReport();
            lrep.id = (1 + (1000 * 1)).ToString();
            lrep.rootid = 1.ToString();
            lrep.tartib = 1;
            lrep.title = msg;
            if(msg=="error")
                lrep.error = msg;
            lrep.type = "r2";
            lrep.type1 = "str";
            andReps.Add(lrep);
            return lrep;
        }
    }



    public class learnkeyReport
    {
        public string id { get; set; }
        public string rootid { get; set; }
        public int rootlevel { get; set; }      //
        public string type1 { get; set; }      //r1 r2 d
        public int tartib { get; set; }      //
        public string title { get; set; }     //
        public string type { get; set; }    //int str img
        public string matn { get; set; }   //

        public string matn2 { get; set; }
        public string matn3 { get; set; }
        public string matn4 { get; set; }
        public string date { get; set; }      //news
        public string error { get; set; }
        public int FolderChildCount { get; set; }
        public int _new { get; set; }       //new
        public string color { get; set; }
        public string colour { get; set; }
        public string address { get; set; }
        //public string ItemNo { get; set; }

    }

    public class learnkeyReport2
    {
        public string id { get; set; }   //
        public string title { get; set; }     //
        public string desc { get; set; }    //int str img
        public string pic { get; set; }   //

        public string off { get; set; }
        public string price { get; set; }
        public string url { get; set; }
        public string gurl { get; set; }  
    }
}  
