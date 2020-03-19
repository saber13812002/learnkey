using Microsoft.SharePoint.Client;
using MvcApp_csom_irib_01.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using SP = Microsoft.SharePoint.Client;
using System.Net;
using Microsoft.SharePoint.Client;
using Microsoft.SharePoint;
using Microsoft.SharePoint.Utilities;

//namespace MvcApp_irib_spClass.Controllers
//{
//    public class ValuesController : ApiController
//    {
//        // GET api/values
//        public IEnumerable<string> Get()
//        {
//            return new string[] { "value1", "value2" };
//        }

//        // GET api/values/5
//        public string Get(int id)
//        {
//            SP sp = new SP();

//            return "value";
//        }

//        // POST api/values
//        public void Post([FromBody]string value)
//        {
//        }

//        // PUT api/values/5
//        public void Put(int id, [FromBody]string value)
//        {
//        }

//        // DELETE api/values/5
//        public void Delete(int id)
//        {
//        }
//    }
//}


namespace MvcApp_irib_spClass.Controllers
{

    // GET irib/setNewItem/user/passwordaA1/Tasks/title/body/
    public class setNewItemController : ApiController
    {
        // GET irib/setNewItem/user/passwordaA1/Tasks/title/body/
        public IEnumerable<string> Get()
        {

            return new string[] { "value1", "value2" };
        }

        // GET irib/setNewItem/user/passwordaA1/Tasks/title/body/
        public string Get(string user, string password, string id, string id1, string id2)
        {
            sharepoint shp = new sharepoint();
            string siteUrl = shp.servername;

            //ClientContext clientContext = new ClientContext(siteUrl);
            //SP.List oList = clientContext.Web.Lists.GetByTitle(id);


            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                SP.List oList = context.Web.Lists.GetByTitle(id);
                //context.ExecuteQuery();


                ListItemCreationInformation itemCreateInfo = new ListItemCreationInformation();
                ListItem oListItem = oList.AddItem(itemCreateInfo);
                oListItem["Title"] = id1;
                oListItem["Body"] = id2;

                oListItem.Update();

                context.ExecuteQuery();

            }
            return "task with name " + id1 + " with body " + id2 + " created";
        }

        // POST api/values
        public void Post([FromBody]string value)
        {
        }

        // PUT api/values/5
        public void Put(int id, [FromBody]string value)
        {
        }

        // DELETE api/values/5
        public void Delete(int id)
        {
        }
    }


    // GET irib/getItemDoc/user/passwordaA1/Tasks/
    public class getItemDocController : ApiController
    {
        // GET irib/getItem/user/passwordaA1/Tasks/
        public IEnumerable<string> Get()
        {

            return new string[] { "value1", "value2" };
        }

        // GET api/values/5
        public string Get(string user, string password, string id)
        {
            sharepoint shp = new sharepoint();

            string str = "";
            string siteUrl = shp.servername;

            //ClientContext clientContext = new ClientContext(siteUrl);
            //SP.List oList = clientContext.Web.Lists.GetByTitle(id);


            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                SP.List oList = context.Web.Lists.GetByTitle(id);
                //context.ExecuteQuery();


                //ListItemCreationInformation itemCreateInfo = new ListItemCreationInformation();
                //ListItem oListItem = oList.AddItem(itemCreateInfo);
                //oListItem["Title"] = id1;
                //oListItem["Body"] = id2;

                context.Load(oList);
                context.ExecuteQuery();
                //list.TemplateFeatureId.ToString().Equals("") &&
                string baseType = oList.BaseType.ToString();
                string listTitle = oList.Title.ToString();
                if (oList.BaseType.ToString().Equals("DocumentLibrary", StringComparison.InvariantCultureIgnoreCase) && oList.Title.ToString().Equals(id, StringComparison.InvariantCultureIgnoreCase))
                {
                    foreach (Folder subFolder in oList.RootFolder.Folders)
                    {
                        foreach (File f in subFolder.Files)
                        {
                            str += f.Title.ToString();
                        }
                    }
                }

            }
            return str;
        }

        // POST api/values
        public void Post([FromBody]string value)
        {
        }

        // PUT api/values/5
        public void Put(int id, [FromBody]string value)
        {
        }

        // DELETE api/values/5
        public void Delete(int id)
        {
        }
    }

    // GET irib/getItem/user/passwordaA1/reports/
    public class getItemController : ApiController
    {
        // GET irib/getItem/user/passwordaA1/reports/
        public IEnumerable<string> Get()
        {

            return new string[] { "value1", "value2" };
        }

        // GET irib/getItem/user/passwordaA1/reports/
        public string Get(string user, string password, string id)
        {
            sharepoint shp = new sharepoint();

            string str = "";
            string siteUrl = shp.servername;

            //ClientContext clientContext = new ClientContext(siteUrl);
            //SP.List oList = clientContext.Web.Lists.GetByTitle(id);


            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                //SP.List oList = context.Web.Lists.GetByTitle(id);
                //context.ExecuteQuery();
                SP.List oList = context.Web.Lists.GetByTitle(id);
                CamlQuery query = new CamlQuery();
                query.ViewXml =
                   @"<View>
                        <Query>
                            <Where>
                                <IsNull><FieldRef Name='ParentID' /></IsNull>
                            </Where>
                        </Query>
                    </View>";
                ListItemCollection items = oList.GetItems(query);

                //ListItemCreationInformation itemCreateInfo = new ListItemCreationInformation();
                //ListItem oListItem = oList.AddItem(itemCreateInfo);
                //oListItem["Title"] = id1;
                //oListItem["Body"] = id2;

                context.Load(oList);
                context.ExecuteQuery();
                //list.TemplateFeatureId.ToString().Equals("") &&
                string baseType = oList.BaseType.ToString();
                string listTitle = oList.Title.ToString();
                if (oList.BaseType.ToString().Equals("GenericList", StringComparison.InvariantCultureIgnoreCase) && oList.Title.ToString().Equals(id, StringComparison.InvariantCultureIgnoreCase))
                {
                    //foreach (Folder subFolder in oList.RootFolder.Folders)
                    //{
                    //    foreach (File f in subFolder.Files)
                    //    {
                    //        str += f.Title.ToString();
                    //    }
                    //}

                }

            }
            return str;
        }

        // POST api/values
        public void Post([FromBody]string value)
        {
        }

        // PUT api/values/5
        public void Put(int id, [FromBody]string value)
        {
        }

        // DELETE api/values/5
        public void Delete(int id)
        {
        }
    }



    // GET irib/getRoot/user/passwordaA1/tree/0/
    public class getRootController : ApiController
    {
        public List<AndroidReport> andReps = new List<AndroidReport>();


        // GET irib/getRoot/user/passwordaA1/tree/0/
        public IEnumerable<string> Get()
        {

            return new string[] { "value1", "value2" };
        }

        // GET irib/getRoot/user/passwordaA1/tree/0/
        public List<AndroidReport> Get(string user, string password, string listname, int id1)
        {
            sharepoint shp = new sharepoint();
            string siteUrl = shp.servername;

            string str = "";


            //ClientContext clientcontext = new ClientContext(siteUrl);

            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                //SP.List oList = context.Web.Lists.GetByTitle(id);
                Web web = context.Web;
                List list = web.Lists.GetByTitle(listname);
                //todo
                //context.Load(list.GetItems(CamlQuery.CreateAllFoldersQuery());
                var listItemColl = list.GetItems(CamlQuery.CreateAllItemsQuery());
                //CamlQuery camlQuery = new CamlQuery();
                //camlQuery.ViewXml = "<View Scope=\"RecursiveAll\"><RowLimit></RowLimit></View>";
                //ListItemCollection items = list.GetItems(camlQuery);
                context.Load(listItemColl,
                    eachItem => eachItem.Include(
                        item => item,
                        item => item["Title"],
                        item => item["_x0069_d1"],
                        item => item["parent"],
                        item => item["type1"],
                        item => item["matn"])
                    );
                try
                {

                    context.ExecuteQuery();
                }
                catch (Exception e1)
                {
                    AndroidReport andRep = new AndroidReport();
                    andRep.error = e1.Message;
                    andReps.Add(andRep);
                    return andReps;
                    throw;
                }

                //ListItem item = items[0];
                int tartib = 0;
                int flag_show = 0;
                foreach (ListItem item in listItemColl)
                {
                    AndroidReport andRep = new AndroidReport();

                    andRep.id = int.Parse(item["_x0069_d1"].ToString());
                    andRep.title = item["Title"].ToString();
                    andRep.rootid = int.Parse(item["parent"].ToString());
                    if (andRep.rootid == id1)
                    {
                        flag_show = 1;
                        andRep.tartib = ++tartib;
                    }
                    andRep.type1 = item["type1"].ToString();

                    if (item["matn"] != null)
                        andRep.matn = item["matn"].ToString();
                    else
                        andRep.matn = "null";

                    //andRep.rootlevel = int.Parse(item["_Level"].ToString());
                    //int a = int.Parse(item["ItemChildCount"].ToString());
                    //int b = int.Parse(item["FolderChildCount"].ToString());
                    //if (a > b)
                    //    andRep.FolderChildCount = a;
                    //else
                    //    andRep.FolderChildCount = b;
                    //note
                    //todo: r1 when subfolder in data downsn exist
                    //if (andRep.FolderChildCount >= 0)
                    //    andRep.type = "r1";
                    if (flag_show == 1)
                        andReps.Add(andRep);
                    flag_show = 0;
                }
                //Console.WriteLine(item["ContentTypeId"]);
                //0x01200400A4C8A09A4597944DAE38AF2E6E57A360 is the GUID of summary task which is already added to my list
                //item["ContentTypeId"] = "0x01200400A4C8A09A4597944DAE38AF2E6E57A360";
                //item["ContentTypeId"] = "0x012004004FE077B3E556A148A8BB98C76EA453AF";
                //item.Update();
                //context.ExecuteQuery();

                //str = item["ContentTypeId"].ToString();
                //Console.WriteLine("item updated");
            }
            return andReps;
        }
    }

    // GET irib/getRootFolder/user/passwordaA1/reports/r1/حوزه انتشار/
    public class getRootFolderController : ApiController
    {
        public List<AndroidReport> andReps = new List<AndroidReport>();


        // GET irib/getRootFolder/user/passwordaA1/reports/r1/حوزه انتشار/
        public IEnumerable<string> Get()
        {

            return new string[] { "value1", "value2" };
        }

        // GET irib/getRootFolder/user/passwordaA1/reports/r1/حوزه انتشار/
        public List<AndroidReport> Get(string user, string password, string listname, string id1, string id2)
        {
            sharepoint shp = new sharepoint();
            string siteUrl = shp.servername;

            string str = "";


            //ClientContext clientcontext = new ClientContext(siteUrl);

            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                //SP.List oList = context.Web.Lists.GetByTitle(id);
                Web web = context.Web;
                List list = web.Lists.GetByTitle(listname);
                context.Load(list);
                CamlQuery camlQuery = new CamlQuery();

                //if (id1 == "r1")
                //{
                //    camlQuery.FolderServerRelativeUrl = folderServerRelativeUrl;

                //    camlQuery.ViewXml = "<View Scope=\"RecursiveAll\"> " +
                //    "<Query>" +
                //    "<Where>" +
                //                "<Eq>" +
                //                    "<FieldRef Name=\"FileDirRef\" />" +
                //                    "<Value Type=\"Text\">" + folderServerRelativeUrl + "</Value>" +
                //                 "</Eq>" +
                //    "</Where>" +
                //    "</Query>" +
                //    "</View>";

                //}
                //else


                //<View Scope=\"RecursiveAll\">
                //camlQuery.ViewXml = "<View Scope=\"Recursive\"><Query><Where><Eq><FieldRef Name=\"FileDirRef\" /><Value Type=\"Text\">" + "حوزه انتشار" + "</Value></Eq></Where></Query><RowLimit></RowLimit></View>";
                //camlQuery.ViewXml = "<View Scope=\"Recursive\"><RowLimit></RowLimit></View>";
                camlQuery.ViewXml = "<View Scope=\"RecursiveAll\"><RowLimit></RowLimit></View>";
                ListItemCollection items = list.GetItems(camlQuery);
                context.Load(items);
                try
                {

                    context.ExecuteQuery();
                }
                catch (Exception e1)
                {
                    AndroidReport andRep = new AndroidReport();
                    andRep.error = e1.Message;
                    andReps.Add(andRep);
                    return andReps;
                    throw;
                }

                //ListItem item = items[0];

                foreach (ListItem item in items)
                {
                    AndroidReport andRep = new AndroidReport();

                    andRep.id = int.Parse(item["ID"].ToString());
                    andRep.title = item["Title"].ToString();
                    andRep.rootlevel = int.Parse(item["_Level"].ToString());
                    int a = int.Parse(item["ItemChildCount"].ToString());
                    int b = int.Parse(item["FolderChildCount"].ToString());
                    if (a > b)
                        andRep.FolderChildCount = a;
                    else
                        andRep.FolderChildCount = b;
                    //note
                    //todo: r1 when subfolder in data downsn exist
                    if (andRep.FolderChildCount >= 0)
                        andRep.type = "r1";

                    andReps.Add(andRep);
                }
                //Console.WriteLine(item["ContentTypeId"]);
                //0x01200400A4C8A09A4597944DAE38AF2E6E57A360 is the GUID of summary task which is already added to my list
                //item["ContentTypeId"] = "0x01200400A4C8A09A4597944DAE38AF2E6E57A360";
                //item["ContentTypeId"] = "0x012004004FE077B3E556A148A8BB98C76EA453AF";
                //item.Update();
                //context.ExecuteQuery();

                //str = item["ContentTypeId"].ToString();
                //Console.WriteLine("item updated");
            }
            return andReps;
        }
    }

    // GET irib/getsubFolder/user/passwordaA1/reports/r1/حوزه انتشار/
    public class getSubFolderController : ApiController
    {
        public List<AndroidReport> andReps = new List<AndroidReport>();


        // GET irib/getsubFolder/user/passwordaA1/reports/r1/حوزه انتشار/
        //public IEnumerable<string> Get()
        //{
        //    sharepoint shp = new sharepoint();
        //    using (ClientContext ctx = new ClientContext(shp.servername))
        //    {
        //        //ctx.ExecutingWebRequest += new EventHandler<WebRequestEventArgs>();

        //        try
        //        {
        //            Web web = ctx.Web;
        //            List list = web.Lists.GetByTitle("reports");
        //            ContentTypeCollection contentTypeColl = list.ContentTypes;
        //            ctx.Load(contentTypeColl);
        //            ctx.ExecuteQuery();
        //            //var stctid = from ct in contentTypeColl
        //            //             where ct.Name == "Summary Task"
        //            //             select ct.Id;
        //            ContentType contentType = null;
        //            foreach (ContentType ct in contentTypeColl)
        //            {
        //                if (ct.Name == "Summary Task")
        //                    contentType = ct;
        //            }


        //            // Create the Listitem
        //            // ListItemCreationInformation can bee null for root folder
        //            //ListItemCreationInformation createInfo = null;

        //            //// Or for adding item to a folder
        //            //ListItemCreationInformation createInfo = new ListItemCreationInformation();
        //            //createInfo.FolderUrl = "/lists/Schedule_635/Sample Item";

        //            ListItem listItem = list.GetItemById(12);

        //            listItem["Title"] = "Demo Title";

        //            //ListItem item = list.AddItem(createInfo);

        //            //// Set the FieldValues
        //            //item["Title"] = "Sample Item";
        //            //item["ContentTypeId"] = contentId;
        //            listItem["Content Type"] = contentType.Name;
        //            listItem["ContentTypeId"] = contentType.Id.ToString();
        //            ////// Save changes
        //            //item.Update();
        //            //listItem["ContentTypeId"] = contentType.Id;
        //            listItem.Update();
        //            //// Commit
        //            ctx.ExecuteQuery();
        //        }
        //        catch (Exception ex)
        //        {
        //            string str=ex.Message.ToString();
        //        }
        //    }
        //    return new string[] { "value1", "value2" };
        //}

        // GET irib/getsubfolder/
        public bool Get()
        {
            sharepoint shp = new sharepoint();
            using (ClientContext context = new ClientContext(shp.servername))
            {
                List TaskList = context.Web.Lists.GetByTitle("reports");
                CamlQuery camlQuery = new CamlQuery();
                camlQuery = new CamlQuery();
                camlQuery.ViewXml = "<View Scope='Recursive'>" +
                        "<Query>+" +
                            "<Where>" +
                                "<eq>" +
                                    "<FieldRef Name='FileDirRef'/>" +
                                    "<Value Type='Text'>" +
                    //ecm/Business/Business/Projects/IDECO_P01030000
                                       "/حوزه انتشار" +
                                    "</Value>" +
                                "</eq>" +
                            "</Where>" +
                        "</Query>" +
                        "<RowLimit Paged='TRUE'> 30 </RowLimit>" +
                    "</View>";
                ListItemCollection listItems = TaskList.GetItems(camlQuery);
                context.Load(listItems);
                context.ExecuteQuery();
            }

            return true;
        }


        // GET irib/getsubFolder/user/passwordaA1/reports/r1/حوزه انتشار/
        public List<AndroidReport> Get(string user, string password, string listname, string id1, string id2)
        {
            sharepoint shp = new sharepoint();
            string siteUrl = shp.servername;

            string str = "";


            //ClientContext clientcontext = new ClientContext(siteUrl);

            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                //SP.List oList = context.Web.Lists.GetByTitle(id);
                Web web = context.Web;
                List list = web.Lists.GetByTitle(listname);
                //View view = list.Views.GetByTitle("folderless");
                context.Load(list);
                CamlQuery camlQuery = new CamlQuery();

                //if (id1 == "r1")
                //{
                //    camlQuery.FolderServerRelativeUrl = folderServerRelativeUrl;

                //    camlQuery.ViewXml = "<View Scope=\"RecursiveAll\"> " +
                //    "<Query>" +
                //    "<Where>" +
                //                "<Eq>" +
                //                    "<FieldRef Name=\"FileDirRef\" />" +
                //                    "<Value Type=\"Text\">" + folderServerRelativeUrl + "</Value>" +
                //                 "</Eq>" +
                //    "</Where>" +
                //    "</Query>" +
                //    "</View>";

                //}
                //else
                camlQuery.ViewXml = "<View><RowLimit></RowLimit></View>";
                //camlQuery.ViewXml = "<View><Query>" + view + "</Query></View>";
                ListItemCollection items = list.GetItems(camlQuery);
                context.Load(items);


                //string siteUrl = "http://MyServer/sites/MySiteCollection";
                ClientContext clientContext = new ClientContext(siteUrl);
                SP.List oList = clientContext.Web.Lists.GetByTitle(listname);

                //CamlQuery camlQuery = new CamlQuery();
                camlQuery.ViewXml = "<View><Query><Where><Geq><FieldRef Name='ID'/>" +
                    "<Value Type='Number'>10</Value></Geq></Where></Query><RowLimit>100</RowLimit></View>";
                ListItemCollection collListItem = oList.GetItems(camlQuery);

                clientContext.Load(collListItem);





                SP.CamlQuery query = new SP.CamlQuery();
                query.ViewXml = "<View Scope='RecursiveAll'>" +
                                  "<Query>" +
                                    "<Where>" +
                                      "<And>" +
                                        "<Eq>" +
                                          "<FieldRef Name='ContentType'/>" +
                                          "<Value Type='Text'>Folder</Value>" +
                                        "</Eq>" +
                                        "<Eq>" +
                                          "<FieldRef Name='FileLeafRef'/>" +
                                          "<Value Type='Text'>" + id1 + "</Value>" +  //subFolderName
                                        "</Eq>" +
                                      "</And>" +
                                    "</Where>" +
                                  "</Query>" +
                                "</View>";

                SP.ListItemCollection itemss = list.GetItems(query);
                clientContext.Load(itemss);
                //clientContext.ExecuteQuery();



                try
                {

                    context.ExecuteQuery();


                    clientContext.ExecuteQuery();

                }
                catch (Exception e1)
                {
                    AndroidReport andRep = new AndroidReport();
                    andRep.error = e1.Message;
                    andReps.Add(andRep);
                    return andReps;
                    throw;
                }


                foreach (ListItem oListItem in collListItem)
                {
                    //ID: 
                    var a1 = oListItem.Id;
                    //Title
                    var a2 = oListItem["Title"];
                    //Body
                    //oListItem["Body"];    
                }




                //ListItem item = items[0];

                foreach (ListItem item in items)
                {
                    AndroidReport andRep = new AndroidReport();

                    andRep.id = int.Parse(item["ID"].ToString());
                    andRep.title = item["Title"].ToString();
                    andRep.rootlevel = int.Parse(item["_Level"].ToString());
                    andRep.FolderChildCount = int.Parse(item["FolderChildCount"].ToString());
                    //note
                    //todo: r1 when subfolder in data downsn exist
                    if (andRep.FolderChildCount >= 0)
                        andRep.type = "r1";

                    andReps.Add(andRep);
                }
                //Console.WriteLine(item["ContentTypeId"]);
                //0x01200400A4C8A09A4597944DAE38AF2E6E57A360 is the GUID of summary task which is already added to my list
                //item["ContentTypeId"] = "0x01200400A4C8A09A4597944DAE38AF2E6E57A360";
                //item["ContentTypeId"] = "0x012004004FE077B3E556A148A8BB98C76EA453AF";
                //item.Update();
                //context.ExecuteQuery();

                //str = item["ContentTypeId"].ToString();
                //Console.WriteLine("item updated");
            }
            return andReps;
        }
    }

    public class getSubFolderItemsController : ApiController
    {
        public List<AndroidReport> andReps = new List<AndroidReport>();

        public IEnumerable<string> Get()
        {

            return new string[] { "value1", "value2" };
        }

        // GET irib/getSubFolderItems/user/passwordaA1/reports/r1/حوزه انتشار/
        public List<AndroidReport> Get(string user, string password, string listname, string id1, string id2)
        {
            sharepoint shp = new sharepoint();
            string siteUrl = shp.servername;

            string str = "";

            using (ClientContext context = new ClientContext(siteUrl))
            {
                context.Credentials = new NetworkCredential(user, password, shp.domainname);

                using (SPWeb oWebsiteRoot = SPContext.Current.Site.RootWeb)
                {
                    //SP.List oList = context.Web.Lists.GetByTitle(id);
                    //Web web = context.Web;
                    //List list = oWebsiteRoot.Lists.GetByTitle(listname);
                    //context.Load(list);
                    //CamlQuery camlQuery = new CamlQuery();

                    SPFolder folder = oWebsiteRoot.GetFolder("/Docs/folder1");

                    if (folder.ItemCount > 0)
                    {
                        SPList list = oWebsiteRoot.Lists.TryGetList("ListName");
                        SPQuery query = new SPQuery();
                        query.Folder = folder;
                        SPListItemCollection collListItems = list.GetItems(query);
                    }
                }
            }

            using (SPSite site = new SPSite(siteUrl))
            {
                using (SPWeb web = site.OpenWeb())
                {
                    SPListItemCollection collListItems;

                    SPFolder folder = web.GetFolder("/" + listname + "/" + id2);

                    if (folder.ItemCount > 0)
                    {
                        SPList list = web.Lists.TryGetList(listname);
                        SPQuery query = new SPQuery();
                        query.Folder = folder;
                        collListItems = list.GetItems(query);

                        foreach (SPListItem item in collListItems)
                        {
                            int a = 1;

                        }
                    }


                }
            }
            return andReps;
        }
    }
}

    public class Report
    {
        public int id { get; set; }
        public string name { get; set; }
        public string desc { get; set; }
        public string error { get; set; }
        public int count { get; set; }
        public bool actived { get; set; }
    }


    //public class AndroidReport
    //{
    //    public int id { get; set; }
    //    public int rootid { get; set; }
    //    public int rootlevel { get; set; }
    //    public string type1 { get; set; }
    //    public int tartib { get; set; }
    //    public string title { get; set; }
    //    public string type { get; set; }
    //    public string matn { get; set; }
    //    public string date { get; set; }
    //    public string error { get; set; }
    //    public int FolderChildCount { get; set; }
    //}


    public class AndroidReport
    {
        public int id { get; set; }
        public int rootid { get; set; }
        public int rootlevel { get; set; }
        public string type1 { get; set; }
        public int tartib { get; set; }
        public string title { get; set; }
        public string type { get; set; }
        public string matn { get; set; }
        public string matn2 { get; set; }
        public string matn3 { get; set; }
        public string matn4 { get; set; }
        public string date { get; set; }
        public string error { get; set; }
        public int FolderChildCount { get; set; }
        public int _new { get; set; }
        public string color { get; set; }
        public string colour { get; set; }
        public string address { get; set; }
        public string ItemNo { get; set; }

    }