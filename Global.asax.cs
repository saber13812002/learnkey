using System;
using System.Collections.Generic;
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



        public DataTable runstoreprocedure(string storeprocedurename, string type)
        {
            Table t = new Table();
            try
            {
                //class sp
                // در زمانی که در لوکال روی سرور مرکز اجرا می کنم
                //SqlConnection con = new SqlConnection("Data Source=.;Initial Catalog=learnkey_arjang;Integrated Security=True");
                SqlConnection con = new SqlConnection("Data Source=learnkey.ir;Initial Catalog=asanhost_learnkey;User Id=sabertabatabaei;password=bGd$4p20");
                // در زمانی که در سرور شرکت اجرا می کنم
                //string connStr = ConfigurationManager.ConnectionStrings["remoteSqlServer"].ToString();
                // در زمانی که در سرور شرکت اجرا می کنم
                //SqlConnection con = new SqlConnection(connStr);
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

    }



}