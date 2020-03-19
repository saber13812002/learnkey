using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Http;
using System.Web.Mvc;
using System.Web.Optimization;
using System.Web.Routing;
using System.Web.UI.WebControls;

namespace MvcApp_irib_spClass
{
    // Note: For instructions on enabling IIS6 or IIS7 classic mode, 
    // visit http://go.microsoft.com/?LinkId=9394801

    public class WebApiApplication : System.Web.HttpApplication
    {
        protected void Application_Start()
        {
            AreaRegistration.RegisterAllAreas();

            WebApiConfig.Register(GlobalConfiguration.Configuration);
            FilterConfig.RegisterGlobalFilters(GlobalFilters.Filters);
            RouteConfig.RegisterRoutes(RouteTable.Routes);
            BundleConfig.RegisterBundles(BundleTable.Bundles);
        }

        public int InsertorUPdateMelks(string procedure, MelksType melk, SqlConnection con,bool update)
        {
            int result;

            //string connStr = ConfigurationManager.ConnectionStrings["WindowsFormsApplication2.Properties.Settings.connn"].ToString();
            using ( con )
            {
                SqlCommand cmd = new SqlCommand();
                cmd.Connection = con;
                cmd.CommandTimeout = 120;
                cmd.CommandType = CommandType.StoredProcedure;
                if(!update)
                    cmd.CommandText = procedure;
                else // هیچ فرقی نمیکنه این باشه یا نباشه فقط برای کامنت گذاشتم اینجا
                    cmd.CommandText = "SetUpdateMelks";

                //SetUpdateMelks

                cmd.Parameters.AddWithValue("@Title", melk.Title);
                cmd.Parameters.AddWithValue("@Code", melk.Code);
                cmd.Parameters.AddWithValue("@Type", melk.Type);
                cmd.Parameters.AddWithValue("@Date", melk.Date);
                cmd.Parameters.AddWithValue("@DateJalali", melk.Date);
                cmd.Parameters.AddWithValue("@VisitCount", melk.VisitCount);

                cmd.Parameters.AddWithValue("@GpsLat", (melk.GpsLat != null ? melk.GpsLat : "null"));
                cmd.Parameters.AddWithValue("@GpsLit", (melk.GpsLit != null ? melk.GpsLit : "null"));
                cmd.Parameters.AddWithValue("@Pics", (melk.Pics != null ? melk.Pics : "null"));
                var p = melk.AgentPhone;
                cmd.Parameters.AddWithValue("@AgentPhone", (p != null ? p : "null"));
                p = melk.AgentPhone;
                cmd.Parameters.AddWithValue("@AgentMobile", (p != null ? p : "null"));



                try
                {
                    con.Open();
                    result = Convert.ToInt16(cmd.ExecuteNonQuery());
                    con.Close();
                }
                catch (Exception Ex)
                {
                    result = -2;
                }
            }
            return result;
        }

        public DataTable runstoreprocedure(string storeprocedurename, string type)
        {
            Table t = new Table();
            try
            {
                //class sp
                // در زمانی که در لوکال روی سرور مرکز اجرا می کنم
                //SqlConnection con = new SqlConnection("Data Source=.;Initial Catalog=learnkey_arjang;Integrated Security=True");
                //SqlConnection con = new SqlConnection("Data Source=learnkey.ir;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=bGd$4p20");
                // در زمانی که در سرور شرکت اجرا می کنم
                //string connStr = ConfigurationManager.ConnectionStrings["remoteSqlServer"].ToString();
                string connStr = ConfigurationManager.ConnectionStrings["LearnKeyConnection"].ToString();
                // در زمانی که در سرور شرکت اجرا می کنم
                SqlConnection con = new SqlConnection(connStr);
                //stored procedure name
                SqlCommand command = new SqlCommand(storeprocedurename, con);
                command.CommandType = CommandType.StoredProcedure;

                SqlDataAdapter da = new SqlDataAdapter(command);

                DataSet ds = new DataSet();
                //if (type == "button")
                //    da.SelectCommand.Parameters.Add("@type", SqlDbType.Int).Value = 2;
                //else if (type == "link")
                //    da.SelectCommand.Parameters.Add("@type", SqlDbType.Int).Value = 3;
                da.Fill(ds);

                //DataTable dt = 
                return ds.Tables[0]; ;

            }
            catch (Exception)
            {
                throw;
            }
        }



        public bool getStatusItemById(string procedure, string MelkCode)
        {

            int result;
            DataSet ds = new DataSet();

            string connStr = ConfigurationManager.ConnectionStrings["LearnKeyConnection"].ToString();
            using (SqlConnection con = new SqlConnection(connStr))
            {
                SqlCommand cmd = new SqlCommand();
                cmd.Connection = con;
                cmd.CommandTimeout = 120;
                cmd.CommandType = CommandType.StoredProcedure;
                cmd.CommandText = procedure;
                cmd.Parameters.AddWithValue("@MelkCode", MelkCode);

                try
                {
                    con.Open();
                    var adapter = new SqlDataAdapter(cmd);
                    adapter.Fill(ds);

                    return (ds.Tables[0].Rows.Count > 0 ? true : false);
                    
                }
                catch (Exception Exception)
                {

                }
                finally 
                {
                    con.Close(); 
                }
            }

            return false;

        }
    }


    public class MelksType
    {

        public string Title { set; get; }
        public string Code { set; get; }
        public string Type { set; get; }
        public string Date { set; get; }
        public string VisitCount { set; get; }
        public string GpsLat { set; get; }
        public string GpsLit { set; get; }
        public string Pics { set; get; }
        public string AgentName { set; get; }
        public string AgentPhone { set; get; }
        public string AgentMobile { set; get; }
    }

}