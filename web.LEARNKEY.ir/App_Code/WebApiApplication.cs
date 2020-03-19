using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Web.UI.WebControls;

public class WebApiApplication
{
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

